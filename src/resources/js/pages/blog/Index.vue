<script setup lang="ts">
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import SeoHead from '@/components/SeoHead.vue';
import { Avatar, AvatarFallback } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { blogSchema } from '@/lib/seo';
import { SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Search } from '@lucide/vue';
import { computed, ref } from 'vue';

interface BlogPost {
    date: number;
    slug: string;
    title: string;
    categories: string[];
    tags: string[];
    excerpt: string;
    author: string;
    contents: {
        html: string;
    };
    path: string;
}

const props = defineProps<SharedData>();
const description = `Read the latest sleep calculator guides and updates from ${props.name}.`;

const page = usePage();
const posts = computed<BlogPost[]>(() => {
    return page.props.posts as BlogPost[];
});

const categories = computed(() => {
    const allCategories = new Set<string>();
    posts.value.forEach((post) => {
        post.categories.forEach((category) => {
            allCategories.add(category);
        });
    });

    return ['All', ...Array.from(allCategories)];
});

const selectedCategory = ref('All');
const searchQuery = ref('');

const filteredPosts = computed(() => {
    // Categoryu
    let results = selectedCategory.value === 'All' ? posts.value : posts.value.filter((post) => post.categories.includes(selectedCategory.value));

    // Search
    if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase().trim();
        results = results.filter((post) => post.title.toLowerCase().includes(query) || post.excerpt.toLowerCase().includes(query));
    }

    return results;
});

function selectCategory(category: string) {
    selectedCategory.value = category;
}

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
        title="Blog"
        :description="description"
        :canonical="route('blog.index')"
        page-type="CollectionPage"
        :schemas="[blogSchema(props.name, route('blog.index'))]"
    />

    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="stars flex-1">
            <div class="container mx-auto max-w-6xl px-4 py-16">
                <div class="mb-12 text-center">
                    <h1 class="font-montserrat text-4xl font-bold tracking-tight">{{ props.name }} <span class="sleep-text-gradient">Blog</span></h1>
                    <p class="text-muted-foreground mx-auto mt-4 max-w-2xl text-xl">Read the latest blog posts from {{ props.name }}.</p>
                </div>

                <div class="relative grid grid-cols-1 gap-8 md:grid-cols-4">
                    <div class="space-y-6 md:col-span-1">
                        <div class="relative">
                            <Search class="text-muted-foreground absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 transform" />
                            <Input v-model="searchQuery" placeholder="Search articles..." class="pl-10" />
                        </div>

                        <div>
                            <h3 class="mb-3 font-medium">Categories</h3>
                            <ul class="space-y-2">
                                <li v-for="category in categories" :key="category">
                                    <Button
                                        :variant="category === selectedCategory ? 'default' : 'ghost'"
                                        size="sm"
                                        class="w-full justify-start"
                                        @click="selectCategory(category)"
                                    >
                                        {{ category }}
                                    </Button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2">
                            <Card v-for="post in filteredPosts" :key="post.slug" class="flex h-full flex-col py-4">
                                <CardHeader>
                                    <div class="mb-2 flex items-start justify-between">
                                        <span class="bg-primary/10 text-primary rounded-full px-2 py-1 text-xs">
                                            {{ post.categories.join(', ') }}
                                        </span>
                                    </div>
                                    <CardTitle class="hover:text-primary text-xl transition-colors">
                                        <Link :href="route('blog.show', post.slug)">{{ post.title }}</Link>
                                    </CardTitle>
                                    <CardDescription class="flex items-center gap-2 pt-2 text-xs">
                                        <span>{{ formatDate(post.date) }}</span>
                                    </CardDescription>
                                </CardHeader>
                                <CardContent class="grow">
                                    <p class="text-muted-foreground text-sm">{{ post.excerpt }}</p>
                                </CardContent>
                                <CardFooter class="flex items-center justify-between border-t pt-4">
                                    <div class="flex items-center gap-2">
                                        <Avatar class="h-8 w-8">
                                            <AvatarFallback class="bg-primary/10 text-primary text-xs">
                                                {{ post.author.charAt(0).toUpperCase() }}
                                            </AvatarFallback>
                                        </Avatar>
                                        <div>
                                            <p class="text-sm font-medium">{{ post.author }}</p>
                                        </div>
                                    </div>
                                    <Button variant="ghost" size="sm">
                                        <Link :href="route('blog.show', post.slug)">Read More</Link>
                                    </Button>
                                </CardFooter>
                            </Card>
                        </div>

                        <!-- <div class="flex justify-center mt-10">
                            <div class="flex gap-2">
                                <Button variant="outline" size="sm" disabled>Previous</Button>
                                <Button size="sm">1</Button>
                                <Button variant="outline" size="sm">2</Button>
                                <Button variant="outline" size="sm">3</Button>
                                <Button variant="outline" size="sm">Next</Button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </main>
        <Footer />
    </div>
</template>
