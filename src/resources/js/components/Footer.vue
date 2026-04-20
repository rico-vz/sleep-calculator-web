<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLogoIcon from './AppLogoIcon.vue';

const props = defineProps({
    appName: String,
});

const currentYear = ref(new Date().getFullYear());
</script>

<template>
    <footer
        class="border-border/30 bg-background/90 supports-backdrop-filter:bg-background/60 border-t py-8 shadow-[0_-1px_0_rgba(0,0,0,0.03)] backdrop-blur"
    >
        <div class="container max-w-(--breakpoint-xl)">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <AppLogoIcon class="h-6 w-6" />
                        <span class="text-lg font-bold tracking-tight">
                            {{ props.appName }}
                        </span>
                    </div>
                    <p class="text-muted-foreground text-sm [text-wrap:pretty]">A good day starts with a good night's sleep.</p>
                </div>
                <div>
                    <h3 class="text-foreground/90 mb-3 font-medium">Resources</h3>
                    <ul class="space-y-2">
                        <li>
                            <Link
                                href="/blog"
                                class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-sm transition-colors"
                            >
                                Blog
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/about"
                                class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-sm transition-colors"
                            >
                                About
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/faq"
                                class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-sm transition-colors"
                            >
                                FAQ
                            </Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-foreground/90 mb-3 font-medium">{{ appName }}</h3>
                    <ul class="space-y-2">
                        <li>
                            <Link
                                href="/about"
                                class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-sm transition-colors"
                            >
                                About
                            </Link>
                        </li>
                        <li>
                            <a
                                href="mailto:contact@sleeputility.com"
                                class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-sm transition-colors"
                            >
                                Email
                            </a>
                        </li>
                        <li>
                            <Link
                                href="/privacy"
                                class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-sm transition-colors"
                            >
                                Privacy Policy
                            </Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-foreground/90 mb-3 font-medium">Social</h3>
                    <ul class="space-y-2">
                        <li>
                            <a
                                href="https://www.producthunt.com/posts/sleeputility?utm_source=sleeputility"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-sm transition-colors"
                            >
                                ProductHunt
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-border/40 mt-8 flex flex-col items-center justify-between gap-4 border-t pt-6 md:flex-row">
                <p class="text-muted-foreground text-xs">&copy; {{ currentYear }} {{ appName }}. All rights reserved.</p>
                <p class="text-muted-foreground text-xs">
                    Developed by
                    <a href="https://zensodigital.com" class="text-muted-foreground hover:text-primary text-xs"> Zenso Digital </a>
                </p>

                <div class="flex space-x-4">
                    <Link
                        href="/changelog"
                        class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-xs transition-colors"
                    >
                        Changelog
                    </Link>
                    <Link href="/terms" class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-xs transition-colors">
                        Terms of Service
                    </Link>
                    <Link
                        href="/privacy"
                        class="text-muted-foreground hover:text-primary inline-flex min-h-10 items-center text-xs transition-colors"
                    >
                        Privacy
                    </Link>
                </div>
            </div>
        </div>
    </footer>
</template>
