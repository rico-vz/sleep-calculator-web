<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue'
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Download, Trash2 } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Backups',
        href: '/dashboard/backups',
    },
];

const page = usePage()
const backups = computed(() => {
    return page.props.backups as any[];
});

const getFilename = (fullPath: string) => {
    return fullPath.replace(/^backups\//, '');
};

const deleteDialog = ref(false);
const backupToDelete = ref<string | null>(null);

const confirmDelete = (filename: string) => {
    backupToDelete.value = filename;
    deleteDialog.value = true;
};

const deleteBackup = () => {
    if (backupToDelete.value) {
        router.delete(route('dashboard.backups.delete', { filename: backupToDelete.value }), {
            onSuccess: () => {
                deleteDialog.value = false;
                backupToDelete.value = null;
            },
            onError: () => {
                console.error('didnt delete backup:', backupToDelete.value);
            }
        });
    }
};

const cancelDelete = () => {
    deleteDialog.value = false;
    backupToDelete.value = null;
};

</script>

<template>

    <Head title="Backups" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="p-4">
                    <h1 class="text-2xl font-bold mb-4">Backups</h1>
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="border-b border-border/70">
                                <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Backup</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="backup in backups" :key="backup" class="border-b border-border/70">
                                <td class="px-4 py-3 font-mono text-sm">{{ getFilename(backup) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a :href="route('dashboard.backups.download', { filename: getFilename(backup) })"
                                            download>
                                            <Button variant="outline" size="sm" class="gap-2">
                                                <Download class="h-4 w-4" />
                                                Download
                                            </Button>
                                        </a>

                                        <Button variant="destructive" size="sm" class="gap-2"
                                            @click="confirmDelete(getFilename(backup))">
                                            <Trash2 class="h-4 w-4" />
                                            Delete
                                        </Button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <Dialog v-model:open="deleteDialog">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Delete Backup</DialogTitle>
                    <DialogDescription>
                        Are you sure you want to delete this backup? This action cannot be undone.
                        <br><br>
                        <strong>{{ backupToDelete }}</strong>
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter class="gap-2">
                    <Button variant="outline" @click="cancelDelete">Cancel</Button>
                    <Button variant="destructive" @click="deleteBackup">Delete</Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
