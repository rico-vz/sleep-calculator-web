<script setup lang="ts">
import { Brain, TimerReset, Coffee } from "lucide-vue-next";

const props = defineProps({
    appName: String
});
</script>

<template>
    <section class="py-16 bg-muted/30">
        <div class="container mx-auto max-w-5xl px4">
            <h2 class="text-3xl font-bold tracking-tight text-center mb-12">
                How it works
            </h2>

            <div class="grid gap-8 md:grid-cols-3">
                <div class="bg-card rounded-lg p-6 shadow-md border flex flex-col items-center text-center">
                    <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <TimerReset class="h-6 w-6 text-primary" />
                    </div>
                    <h3 class="text-xl font-semibold mb-2 font-montserrat">Track Sleep Cycles</h3>
                    <p class="text-muted-foreground">
                        {{ props.appName }} works by calculating natural sleep cycles, which usually last around 90
                        minutes
                        each.
                    </p>
                </div>

                <div class="bg-card rounded-lg p-6 shadow-md border flex flex-col items-center text-center">
                    <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <Brain class="h-6 w-6 text-primary" />
                    </div>
                    <h3 class="text-xl font-semibold mb-2 font-montserrat">Sleep Science</h3>
                    <p class="text-muted-foreground">
                        {{ props.appName }} uses science to help you avoid waking up during deep sleep, preventing
                        grogginess.
                    </p>
                </div>

                <div class="bg-card rounded-lg p-6 shadow-md border flex flex-col items-center text-center">
                    <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <Coffee class="h-6 w-6 text-primary" />
                    </div>
                    <h3 class="text-xl font-semibold mb-2 font-montserrat">Better Mornings</h3>
                    <p class="text-muted-foreground">
                        Wake up at the right time in your cycle to feel more refreshed and energized throughout the day.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
