<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Search } from 'lucide-vue-next';
import { SharedData } from '@/types';
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
import { computed, ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle
} from "@/components/ui/card";
import {
    Avatar,
    AvatarFallback
} from "@/components/ui/avatar";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";


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

const page = usePage()
const posts = computed<BlogPost[]>(() => {
    return page.props.posts as BlogPost[];
})

const categories = computed(() => {
    const allCategories = new Set<string>();
    posts.value.forEach((post) => {
        post.categories.forEach((category) => {
            allCategories.add(category);
        });
    });

    return ['All', ...Array.from(allCategories)];
})

const selectedCategory = ref('All');
const searchQuery = ref('');


const filteredPosts = computed(() => {
    // Categoryu
    let results = selectedCategory.value === 'All'
        ? posts.value
        : posts.value.filter(post => post.categories.includes(selectedCategory.value));

    // Search
    if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase().trim();
        results = results.filter(post =>
            post.title.toLowerCase().includes(query) ||
            post.excerpt.toLowerCase().includes(query)
        );
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
        day: 'numeric'
    });
}
</script>

<template>

    <Head title="Blog" />

    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <main class="flex-1 stars">
            <div class="container max-w-6xl mx-auto py-16 px-4">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold font-montserrat tracking-tight">
                        {{ props.name }} <span class="sleep-text-gradient">Blog</span>
                    </h1>
                    <p class="text-xl text-muted-foreground mt-4 max-w-2xl mx-auto">
                        Read the latest blog posts from {{ props.name }}.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                    <div class="md:col-span-1 space-y-6">
                        <div class="relative">
                            <Search
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground h-4 w-4" />
                            <Input v-model="searchQuery" placeholder="Search articles..." class="pl-10" />
                        </div>

                        <div>
                            <h3 class="font-medium mb-3">Categories</h3>
                            <ul class="space-y-2">
                                <li v-for="category in categories" :key="category">
                                    <Button :variant="category === selectedCategory ? 'default' : 'ghost'" size="sm"
                                        class="w-full justify-start" @click="selectCategory(category)">
                                        {{ category }}
                                    </Button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2">
                            <Card v-for="post in filteredPosts" :key="post.slug" class="flex flex-col h-full py-4">
                                <CardHeader>
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-full">
                                            {{ post.categories.join(', ') }}
                                        </span>
                                    </div>
                                    <CardTitle class="text-xl hover:text-primary transition-colors">
                                        <Link :href="route('blog.show', post.slug)">{{ post.title }}</Link>
                                    </CardTitle>
                                    <CardDescription class="flex items-center gap-2 text-xs pt-2">
                                        <span>{{ formatDate(post.date) }}</span>
                                    </CardDescription>
                                </CardHeader>
                                <CardContent class="flex-grow">
                                    <p class="text-muted-foreground text-sm">{{ post.excerpt }}</p>
                                </CardContent>
                                <CardFooter class="border-t pt-4 flex justify-between items-center">
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
