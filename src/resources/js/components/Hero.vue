<script setup lang="ts">
import SleepCalculator from './sleep-calculator/SleepCalculator.vue';

const props = defineProps({
    appName: String,
    timeToFallAsleep: Number,
});
</script>

<template>
    <section class="px-4 py-16 md:py-24">
        <div class="container mx-auto max-w-5xl">
            <div class="mb-12 space-y-4 text-center md:mb-14">
                <h1
                    class="text-4xl font-bold tracking-tighter [text-wrap:balance] md:text-5xl lg:text-6xl"
                >
                    Optimize Your <span class="sleep-text-gradient">Sleep 💤</span>
                </h1>
                <p
                    class="text-muted-foreground mx-auto max-w-2xl text-xl [text-wrap:pretty]"
                >
                    {{ appName }} helps you wake up feeling refreshed by calculating the best times to fall asleep or wake up based on the average
                    sleep cycles.
                </p>
            </div>
        </div>
        <div>
            <SleepCalculator :appName="props.appName" :timeToFallAsleep="props.timeToFallAsleep" />
        </div>
    </section>
</template>
