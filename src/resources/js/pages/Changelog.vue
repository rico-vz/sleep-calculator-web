<script setup lang="ts">
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import SeoHead from '@/components/SeoHead.vue';
import { Avatar, AvatarFallback } from '@/components/ui/avatar';
import { Separator } from '@/components/ui/separator';
import { SharedData } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { Calendar, Tag } from '@lucide/vue';
import { computed } from 'vue';

interface Changelogs {
    date: number;
    lastmod: number;
    slug: string;
    title: string;
    tags: string[];
    excerpt: string;
    author: string;
}

const props = defineProps<SharedData>();
const page = usePage();

const changelog = computed<Changelogs>(() => {
    return page.props.changelog as Changelogs;
});

const changelogContent = computed(() => {
    return page.props.content;
});

function formatDate(unix: number): string {
    const date = new Date(unix * 1000);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
}
</script>

<template>
    <SeoHead :title="changelog.title" :description="changelog.excerpt" :canonical="route('changelog.show')" robots="noindex,follow" type="article" />

    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="flex-1">
            <div class="container mx-auto max-w-4xl px-4 py-16">
                <article class="space-y-8">
                    <header class="space-y-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-2">
                                <Avatar class="h-10 w-10">
                                    <AvatarFallback class="bg-primary/10 text-primary">
                                        {{ changelog.author.charAt(0).toUpperCase() }}
                                    </AvatarFallback>
                                </Avatar>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium">{{ changelog.author }}</span>
                                    <span class="text-muted-foreground flex items-center gap-1 text-xs">
                                        <Calendar class="h-3 w-3" />
                                        {{ formatDate(changelog.date) }}
                                    </span>
                                    <span v-if="changelog.lastmod" class="text-muted-foreground flex items-center gap-1 text-xs">
                                        <Calendar class="h-3 w-3" />
                                        Last updated on {{ formatDate(changelog.lastmod) }}
                                    </span>
                                </div>
                            </div>

                            <div v-if="changelog.tags && changelog.tags.length > 0" class="text-muted-foreground flex items-center gap-1 text-xs">
                                <Tag class="h-3 w-3" />
                                <span v-for="(tag, index) in changelog.tags" :key="tag">
                                    {{ tag }}{{ index < changelog.tags.length - 1 ? ', ' : '' }}
                                </span>
                            </div>
                        </div>
                    </header>

                    <Separator />

                    <div
                        class="prose dark:prose-invert prose-headings:scroll-m-20 prose-headings:font-semibold prose-h1:text-3xl prose-h1:lg:text-4xl prose-h2:text-2xl prose-h2:lg:text-3xl prose-h3:text-xl prose-h3:lg:text-2xl prose-h4:text-lg prose-h4:lg:text-xl prose-img:rounded-lg prose-a:text-primary prose-a:underline hover:prose-a:text-primary/80 prose-blockquote:border-l-4 prose-blockquote:border-primary/50 prose-blockquote:pl-4 prose-blockquote:italic prose-blockquote:text-muted-foreground max-w-none"
                        v-html="changelogContent"
                    ></div>
                </article>
            </div>
        </main>
        <Footer :appName="props.name" />
    </div>
</template>
