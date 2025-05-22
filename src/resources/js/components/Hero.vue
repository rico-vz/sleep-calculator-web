<script setup lang="ts">
import SleepCalculator from './sleep-calculator/SleepCalculator.vue';

const props = defineProps({
    appName: String,
    timeToFallAsleep: Number
});
</script>

<template>
    <section class="py-20 px-4">
        <div class="container mx-auto max-w-5xl">
            <div class="text-center space-y-4 mb-12">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tighter">
                    Optimize Your <span class="sleep-text-gradient">Sleep 💤</span>
                </h1>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    {{ appName }} helps you wake up feeling refreshed by calculating the best times to
                    fall asleep or wake up based on the average sleep cycles.
                </p>
            </div>
        </div>
        <SleepCalculator :appName="props.appName" :timeToFallAsleep="props.timeToFallAsleep" />
    </section>
</template>
