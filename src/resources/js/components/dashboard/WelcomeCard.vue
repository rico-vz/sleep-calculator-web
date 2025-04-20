<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { type SharedData, type User } from '@/types';

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const today = new Date().toLocaleDateString('en-US', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
});

const quotes = [
    "There is a time for many words, and there is also a time for sleep.",
    "A good laugh and a long sleep are the best cures in the doctor's book.",
    "We are such stuff as dreams are made on.",
    "No day is so bad it can't be fixed with a nap.",
    "You miss 100% of the naps you don't take.",
    "Never waste any time you can spend sleeping.",
    "Your future depends on your dreams, so go to sleep.",
    "When you lie down, you will not be afraid. Your sleep will be sweet.",
    "There is renewal in rest.",
    "Sleep is the best meditation.",
    "Dreams are the royal road to the unconscious."
];

const randomQuote = ref('');

onMounted(() => {
    randomQuote.value = quotes[Math.floor(Math.random() * quotes.length)];
});
</script>

<template>
    <Card class="h-full flex flex-col">
        <CardContent class="flex flex-col justify-between h-full p-5">
            <div>
                <h3 class="text-xl font-semibold mb-1">Welcome back, {{ user.name }}</h3>
                <p class="text-sm text-muted-foreground">Today is {{ today }}</p>
            </div>
            <div class="mt-4 border-l-4 border-primary pl-3 italic text-sm text-muted-foreground">
                {{ randomQuote }}
            </div>
        </CardContent>
    </Card>
</template>
