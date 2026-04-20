<script setup lang="ts">
import { Brain, Coffee, TimerReset } from '@lucide/vue';

const props = defineProps({
    appName: String,
});
</script>

<template>
    <section class="bg-muted/35 py-16">
        <div class="container mx-auto max-w-5xl px-4">
            <h2 class="mb-12 text-center text-3xl font-bold tracking-tight [text-wrap:balance]">How it works</h2>

            <div class="grid gap-8 md:grid-cols-3">
                <div
                    class="animate-in fade-in slide-in-from-bottom-3 bg-card flex flex-col items-center rounded-2xl p-7 text-center shadow-[0_1px_1px_rgba(0,0,0,0.04),0_12px_32px_rgba(10,14,22,0.08)] ring-1 ring-black/5 duration-700 dark:ring-white/10"
                >
                    <div class="bg-primary/10 ring-primary/20 mb-4 flex h-12 w-12 items-center justify-center rounded-full ring-1">
                        <TimerReset class="text-primary h-6 w-6" />
                    </div>
                    <h3 class="mb-2 text-xl font-semibold [text-wrap:balance]">Track Sleep Cycles</h3>
                    <p class="text-muted-foreground [text-wrap:pretty]">
                        {{ props.appName }} works by calculating natural sleep cycles, which usually last around 90 minutes each.
                    </p>
                </div>

                <div
                    class="animate-in fade-in slide-in-from-bottom-3 bg-card flex flex-col items-center rounded-2xl p-7 text-center shadow-[0_1px_1px_rgba(0,0,0,0.04),0_12px_32px_rgba(10,14,22,0.08)] ring-1 ring-black/5 duration-700 [animation-delay:120ms] dark:ring-white/10"
                >
                    <div class="bg-primary/10 ring-primary/20 mb-4 flex h-12 w-12 items-center justify-center rounded-full ring-1">
                        <Brain class="text-primary h-6 w-6" />
                    </div>
                    <h3 class="mb-2 text-xl font-semibold [text-wrap:balance]">Sleep Science</h3>
                    <p class="text-muted-foreground [text-wrap:pretty]">
                        {{ props.appName }} uses science to help you avoid waking up during deep sleep, preventing grogginess.
                    </p>
                </div>

                <div
                    class="animate-in fade-in slide-in-from-bottom-3 bg-card flex flex-col items-center rounded-2xl p-7 text-center shadow-[0_1px_1px_rgba(0,0,0,0.04),0_12px_32px_rgba(10,14,22,0.08)] ring-1 ring-black/5 duration-700 [animation-delay:240ms] dark:ring-white/10"
                >
                    <div class="bg-primary/10 ring-primary/20 mb-4 flex h-12 w-12 items-center justify-center rounded-full ring-1">
                        <Coffee class="text-primary h-6 w-6" />
                    </div>
                    <h3 class="mb-2 text-xl font-semibold [text-wrap:balance]">Better Mornings</h3>
                    <p class="text-muted-foreground [text-wrap:pretty]">
                        Wake up at the right time in your cycle to feel more refreshed and energized throughout the day.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
