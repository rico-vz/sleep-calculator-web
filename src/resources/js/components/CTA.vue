<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { Heart } from '@lucide/vue';
</script>

<template>
    <section class="py-16">
        <div class="container mx-auto max-w-5xl px-4 text-center">
            <h2 class="mb-4 text-3xl font-bold tracking-tight text-balance">Ready to Improve Your Sleep?</h2>
            <p class="text-muted-foreground mx-auto mb-8 max-w-2xl text-xl text-pretty">
                Sign up for free to track your sleep patterns and customize preferences like your average time to fall asleep!
            </p>
            <div class="flex justify-center gap-4">
                <Link href="/register">
                    <Button size="lg" class="plausible-event-name=CTA+GetStartedNow min-h-11 px-8">
                        <Heart />
                        Get Started Now
                    </Button>
                </Link>
            </div>
        </div>
    </section>
</template>
