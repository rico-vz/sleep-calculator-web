<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';

import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: '/settings/profile',
    },
];
const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    fall_asleep_time: user.sleep_preferences?.fall_asleep_time ?? 0,
});

const submit = () => {
    form.patch(route('sleep-preferences.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Sleep preferences" />

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Sleep Preferences"
                    description="Update the preferences for the sleep calculations" />

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="fall_asleep_time">Time to fall Asleep (min)</Label>
                        <Input id="fall_asleep_time" class="mt-1 block w-full" v-model="form.fall_asleep_time"
                            required type="number" />
                        <InputError class="mt-2" :message="form.errors.fall_asleep_time" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing">Save</Button>

                        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                            <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
