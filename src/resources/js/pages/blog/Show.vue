<script setup lang="ts">
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import SeoHead from '@/components/SeoHead.vue';
import { Avatar, AvatarFallback } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { blogPostingSchema, breadcrumbSchema } from '@/lib/seo';
import { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ArrowLeft, Calendar, Tag } from '@lucide/vue';
import { computed } from 'vue';

interface BlogPost {
    date: number;
    slug: string;
    title: string;
    categories: string[];
    tags: string[];
    excerpt: string;
    author: string;
    contents: string;
    path: string;
}

const props = defineProps<SharedData>();
const page = usePage();

const post = computed<BlogPost>(() => {
    return page.props.post as BlogPost;
});

const postContent = computed(() => {
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
    <SeoHead
        :title="post.title"
        :description="post.excerpt"
        :canonical="route('blog.show', post.slug)"
        type="article"
        :schemas="[
            blogPostingSchema(post, route('blog.show', post.slug)),
            breadcrumbSchema([{ name: 'Home', url: route('home') }, { name: 'Blog', url: route('blog.index') }, { name: post.title }]),
        ]"
    />

    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="flex-1">
            <div class="container mx-auto max-w-4xl px-4 py-16">
                <div class="mb-8">
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="route('blog.index')" class="text-muted-foreground hover:text-primary flex items-center gap-2">
                            <ArrowLeft class="h-4 w-4" />
                            Back to all posts
                        </Link>
                    </Button>
                </div>

                <article class="space-y-8">
                    <header class="space-y-6">
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="category in post.categories"
                                :key="category"
                                class="bg-primary/10 text-primary rounded-full px-3 py-1 text-xs"
                            >
                                {{ category }}
                            </span>
                        </div>

                        <h1 class="text-4xl font-bold tracking-tight">
                            {{ post.title }}
                        </h1>

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-2">
                                <Avatar class="h-10 w-10">
                                    <AvatarFallback class="bg-primary/10 text-primary">
                                        {{ post.author.charAt(0).toUpperCase() }}
                                    </AvatarFallback>
                                </Avatar>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium">{{ post.author }}</span>
                                    <span class="text-muted-foreground flex items-center gap-1 text-xs">
                                        <Calendar class="h-3 w-3" />
                                        {{ formatDate(post.date) }}
                                    </span>
                                </div>
                            </div>

                            <div v-if="post.tags && post.tags.length > 0" class="text-muted-foreground flex items-center gap-1 text-xs">
                                <Tag class="h-3 w-3" />
                                <span v-for="(tag, index) in post.tags" :key="tag"> {{ tag }}{{ index < post.tags.length - 1 ? ', ' : '' }} </span>
                            </div>
                        </div>
                    </header>

                    <Separator />

                    <div
                        class="prose dark:prose-invert prose-headings:scroll-m-20 prose-headings:font-semibold prose-h1:text-3xl prose-h1:lg:text-4xl prose-h2:text-2xl prose-h2:lg:text-3xl prose-h3:text-xl prose-h3:lg:text-2xl prose-h4:text-lg prose-h4:lg:text-xl prose-img:rounded-lg prose-a:text-primary prose-a:underline hover:prose-a:text-primary/80 prose-blockquote:border-l-4 prose-blockquote:border-primary/50 prose-blockquote:pl-4 prose-blockquote:italic prose-blockquote:text-muted-foreground max-w-none"
                        v-html="postContent"
                    ></div>

                    <Separator />

                    <footer class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <Button as-child variant="default">
                            <Link :href="route('blog.index')"> Browse More Articles </Link>
                        </Button>
                    </footer>
                </article>
            </div>
        </main>
        <Footer :appName="props.name" />
    </div>
</template>
