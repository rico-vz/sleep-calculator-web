<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { SharedData } from '@/types';
import { Link } from '@inertiajs/vue3';

interface Props {
    auth: SharedData['auth'];
    appName: SharedData['name'];
}

const props = defineProps<Props>();
</script>

<template>
    <header
        class="border-border/30 bg-background/85 supports-backdrop-filter:bg-background/60 border-b shadow-[0_1px_0_rgba(0,0,0,0.03),0_10px_40px_rgba(12,16,28,0.04)] backdrop-blur"
    >
        <div class="container flex h-16 max-w-(--breakpoint-xl) items-center justify-between">
            <div class="flex items-center gap-2">
                <Link :href="route('home')">
                    <img
                        src="/img/sleeputility-logo-transparent.png"
                        alt="SleepUtility Logo"
                        class="h-8 w-8 rounded-full ring-1 ring-black/10 dark:ring-white/10"
                    />
                </Link>
                <div class="flex flex-col">
                    <span class="text-foreground text-xl font-bold tracking-tight">
                        <Link :href="route('home')">{{ appName }}</Link>
                    </span>
                    <span class="text-muted-foreground text-xs"> Optimize your sleep 💤 </span>
                </div>
            </div>
            <nav class="hidden items-center gap-6 md:flex">
                <Link href="/" class="hover:text-primary inline-flex min-h-10 items-center px-1 text-sm font-medium transition-colors"> Home </Link>
                <Link href="/about" class="hover:text-primary inline-flex min-h-10 items-center px-1 text-sm font-medium transition-colors">
                    About
                </Link>
                <Link href="/blog" class="hover:text-primary inline-flex min-h-10 items-center px-1 text-sm font-medium transition-colors">
                    Blog
                </Link>
            </nav>
            <div class="flex items-center gap-2">
                <Link v-if="props.auth.user" :href="route('dashboard')">
                    <Button variant="secondary" size="sm" class="text-sm"> Dashboard </Button>
                </Link>
                <template v-else>
                    <Link :href="route('login')">
                        <Button variant="outline" size="sm"> Sign In </Button>
                    </Link>
                    <Link :href="route('register')">
                        <Button size="sm"> Sign Up </Button>
                    </Link>
                </template>
            </div>
        </div>
    </header>
</template>
