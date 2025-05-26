<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutGrid, UserCog2, Home, DatabaseBackup } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { type SharedData, type User } from '@/types';
import { computed } from 'vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
];

const adminNavItems: NavItem[] = [
    {
        title: 'Backups',
        href: '/dashboard/backups',
        icon: DatabaseBackup,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Sleep Preferences',
        href: '/settings/sleep-preferences',
        icon: UserCog2,
    },
    {
        title: 'Homepage',
        href: '/',
        icon: Home,
    },
];

const page = usePage<SharedData>();
const userRoles = computed(() => page.props.auth.user?.roles || []);
const isAdmin = computed(() => {
    return userRoles.value.some(role => role.name === 'admin');
});

</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
            <NavMain v-if="isAdmin" groupLabel="Admin" :items="adminNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
