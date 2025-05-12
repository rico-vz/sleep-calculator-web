<script setup lang="ts">
import { SharedData } from '@/types';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

interface Props {
    auth: SharedData['auth'];
    appName: SharedData['name'];
}

const props = defineProps<Props>();
</script>

<template>
    <header
        class="border-b border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
        <div class="container flex h-16 max-w-screen-xl items-center justify-between">
            <div class="flex items-center gap-2">
                <Link :href="route('home')">
                <img src="/img/sleeputility-logo-transparent.png" alt="SleepUtility Logo"
                    class="h-8 w-8 rounded-full" />
                </Link>
                <div class="flex flex-col">
                    <span class="text-xl font-bold tracking-tight text-foreground">
                        <Link :href="route('home')">{{ appName }}</Link>
                    </span>
                    <span class="text-xs text-muted-foreground">
                        Optimize your sleep 💤
                    </span>
                </div>
            </div>
            <nav class="hidden md:flex items-center gap-6">
                <Link href="/" class="text-sm font-medium hover:text-primary transition-colors">
                Home
                </Link>
                <Link href="/about" class="text-sm font-medium hover:text-primary transition-colors">
                About
                </Link>
                <Link href="/blog" class="text-sm font-medium hover:text-primary transition-colors">
                Blog
                </Link>
            </nav>
            <div class="flex items-center gap-2">
                <Link v-if="props.auth.user" :href="route('dashboard')">
                <Button variant="secondary" size="sm" class="text-sm">
                    Dashboard
                </Button>
                </Link>
                <template v-else>
                    <Link :href="route('login')">
                    <Button variant="outline" size="sm">
                        Sign In
                    </Button>
                    </Link>
                    <Link :href="route('register')">
                    <Button size="sm">
                        Sign Up
                    </Button>
                    </Link>
                </template>
            </div>
        </div>
    </header>
</template>
