<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import {
    startRegistration,
} from '@simplewebauthn/browser'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];

const props = defineProps<{
    passkeys: { id: string; name: string; last_used_at: string | null }[];
}>();


async function addPassKey() {
    const response = await fetch(route("profile.passkeys.generate-options"));
    const options = await response.json();
    const startAuthenticationResponse = await startRegistration(options);

    router.post(
        route("profile.passkeys.create"),
        {
            options: JSON.stringify(options),
            passkey: JSON.stringify(startAuthenticationResponse)
        }
    );
}

function deletePasskey(id: string) {
    if (confirm("Are you SURE you want to delete this passkey?")) {
        router.delete(
            route("profile.passkeys.delete", { id })
        );
    }
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="Sleep preferences" />

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Sleep Preferences"
                    description="Update the preferences for the sleep calculations" />

                <div v-if="(props.passkeys ?? []).length > 0" class="space-y-6">
                    <div class="grid gap-2">
                        <Label>Your passkeys</Label>
                        <div class="divide-y border rounded-md">
                            <div v-for="passkey in passkeys" :key="passkey.id"
                                class="flex justify-between items-center p-4">
                                <div class="text-sm">
                                    <p class="font-medium">{{ passkey.name }}</p>
                                    <p class="text-muted-foreground">Last used: {{ passkey.last_used_at || 'Never' }}
                                    </p>
                                </div>
                                <Button variant="destructive" size="sm" @click="deletePasskey(passkey.id)">
                                    Delete
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Button @click.prevent="addPassKey">
                        Add a passkey
                    </Button>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
