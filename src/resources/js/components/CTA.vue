<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Heart } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section class="py-16 bg-primary/5">
        <div class="container mx-auto max-w-5xl px-4 text-center">
            <h2 class="text-3xl font-bold tracking-tight mb-4">
                Ready to Improve Your Sleep?
            </h2>
            <p class="text-xl text-muted-foreground max-w-2xl mx-auto mb-8">
                Sign up for free to track your sleep patterns and customize preferences like your average time to fall
                asleep!
            </p>
            <div class="flex gap-4 justify-center">
                <Link href="/register">
                <Button size="lg" class="plausible-event-name=CTA+GetStartedNow">
                    <Heart />
                    Get Started Now
                </Button>
                </Link>
            </div>
        </div>
    </section>
</template>
