<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLogoIcon from './AppLogoIcon.vue';

const props = defineProps({
    appName: String
});

const currentYear = ref(new Date().getFullYear());
</script>

<template>
    <footer
        class="border-t border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60 py-6">
        <div class="container max-w-screen-xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <AppLogoIcon class="h-6 w-6" />
                        <span class="text-lg font-bold tracking-tight ">
                            {{ props.appName }}
                        </span>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        A good day starts with a good night's sleep.
                    </p>
                </div>
                <div>
                    <h3 class="font-medium mb-3 text-foreground/90">Resources</h3>
                    <ul class="space-y-2">
                        <li>
                            <Link href="/blog" class="text-sm text-muted-foreground hover:text-primary">
                            Blog
                            </Link>
                        </li>
                        <li>
                            <Link href="/sleep-science" class="text-sm text-muted-foreground hover:text-primary">
                            Sleep Science
                            </Link>
                        </li>
                        <li>
                            <Link href="/faq" class="text-sm text-muted-foreground hover:text-primary">
                            FAQ
                            </Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-medium mb-3 text-foreground/90">{{ appName }}</h3>
                    <ul class="space-y-2">
                        <li>
                            <Link href="/about" class="text-sm text-muted-foreground hover:text-primary">
                            About
                            </Link>
                        </li>
                        <li>
                            <Link href="/contact" class="text-sm text-muted-foreground hover:text-primary">
                            Contact
                            </Link>
                        </li>
                        <li>
                            <Link href="/privacy" class="text-sm text-muted-foreground hover:text-primary">
                            Privacy Policy
                            </Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-medium mb-3 text-foreground/90">Connect</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="https://X.com" target="_blank" rel="noopener noreferrer"
                                class="text-sm text-muted-foreground hover:text-primary">
                                X (Twitter)
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer"
                                class="text-sm text-muted-foreground hover:text-primary">
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://producthunt.com" target="_blank" rel="noopener noreferrer"
                                class="text-sm text-muted-foreground hover:text-primary">
                                ProductHunt
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div
                class="mt-8 pt-6 border-t border-border/40 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-muted-foreground">
                    &copy; {{ currentYear }} {{ appName }}. All rights reserved.
                </p>
                <div class="flex space-x-4">
                    <Link href="/terms" class="text-xs text-muted-foreground hover:text-primary">
                    Terms of Service
                    </Link>
                    <Link href="/privacy" class="text-xs text-muted-foreground hover:text-primary">
                    Privacy
                    </Link>
                    <Link href="/cookies" class="text-xs text-muted-foreground hover:text-primary">
                    Cookies
                    </Link>
                </div>
            </div>
        </div>
    </footer>
</template>
