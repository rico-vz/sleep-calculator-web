<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Moon, Sun } from '@lucide/vue';
import { ref, watch } from 'vue';
import CalculateBedTime from './CalculateBedTime.vue';
import CalculateWakeTime from './CalculateWakeTime.vue';

interface ResultsType {
    times: Date[];
    type: 'wake' | 'sleep';
}

const props = defineProps({
    appName: String,
    timeToFallAsleep: {
        type: Number,
        default: 15,
    },
});

const activeTab = ref('calculate-bed-time');
const results = ref<ResultsType | null>(null);

watch(activeTab, () => {
    results.value = null;
});

const handleCalculateBedTime = (formData: any) => {
    const wakeTime = new Date();
    let hours = parseInt(formData.hour);
    if (formData.ampm === 'AM' && hours === 12) {
        hours = 0;
    } else if (formData.ampm === 'PM' && hours !== 12) {
        hours += 12;
    }
    wakeTime.setHours(hours);
    wakeTime.setMinutes(parseInt(formData.minute));
    const bedTimes = Array.from({ length: 6 }, (_, i) => {
        const bedTime = new Date(wakeTime);
        bedTime.setMinutes(bedTime.getMinutes() - (i + 1) * 90 - props.timeToFallAsleep);
        return bedTime;
    }).reverse();
    results.value = { times: bedTimes, type: 'sleep' };
};

const handleWakeTimeSubmit = (formData: any) => {
    const sleepTime = new Date();
    let hours = parseInt(formData.hour);
    if (formData.ampm === 'AM' && hours === 12) {
        hours = 0;
    } else if (formData.ampm === 'PM' && hours !== 12) {
        hours += 12;
    }
    sleepTime.setHours(hours);
    sleepTime.setMinutes(parseInt(formData.minute) + props.timeToFallAsleep);
    const wakeTimes = Array.from({ length: 6 }, (_, i) => {
        const wakeTime = new Date(sleepTime);
        wakeTime.setMinutes(wakeTime.getMinutes() + (i + 1) * 90);
        return wakeTime;
    });
    results.value = { times: wakeTimes, type: 'wake' };
};

const formatTime = (date: Date): string => {
    const options: Intl.DateTimeFormatOptions = {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true,
    };
    return date.toLocaleString('en-US', options);
};

const calculateSleepHours = (cycles: number): string => {
    const totalMinutes = cycles * 90;
    const hours = Math.floor(totalMinutes / 60);
    const minutes = totalMinutes % 60;
    return (hours + minutes / 60).toFixed(1).replace(/\.0$/, '');
};
</script>

<template>
    <Card
        class="mx-auto w-full max-w-3xl overflow-hidden rounded-2xl p-6 pt-0 shadow-[0_1px_1px_rgba(0,0,0,0.04),0_24px_60px_rgba(12,16,28,0.1)] ring-1 ring-black/5 dark:ring-white/10"
    >
        <CardHeader class="space-y-1 p-6 text-center">
            <CardTitle class="text-2xl font-bold [text-wrap:balance]"> {{ appName }} Calculator </CardTitle>
            <CardDescription class="[text-wrap:pretty]"> Calculate optimal sleep and wake times based on sleep cycles </CardDescription>
        </CardHeader>
        <CardContent>
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <Button
                    @click="activeTab = 'calculate-bed-time'"
                    :variant="activeTab === 'calculate-bed-time' ? 'default' : 'outline'"
                    class="w-full space-x-2"
                >
                    <Moon class="h-4 w-4" />
                    <span>Calculate bed time</span>
                </Button>
                <Button
                    @click="activeTab = 'calculate-wake-time'"
                    :variant="activeTab === 'calculate-wake-time' ? 'default' : 'outline'"
                    class="w-full space-x-2"
                >
                    <Sun class="h-4 w-4" />
                    <span>Calculate wake time</span>
                </Button>
            </div>

            <div v-if="activeTab === 'calculate-bed-time'" class="space-y-4">
                <CalculateBedTime @submit="handleCalculateBedTime" />
            </div>

            <div v-if="activeTab === 'calculate-wake-time'">
                <CalculateWakeTime @submit="handleWakeTimeSubmit" />
            </div>

            <Transition
                enter-active-class="transition-[opacity,transform] duration-300 ease-out"
                enter-from-class="opacity-0 translate-y-2"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-[opacity,transform] duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 translate-y-2"
            >
                <div v-if="results" class="border-border/70 mt-8 border-t pt-6">
                    <h3 class="mb-4 text-lg font-semibold [text-wrap:balance]">
                        {{ results.type === 'wake' ? 'Optimal Wake-Up Times' : 'Optimal Bedtimes' }}
                    </h3>
                    <p class="text-muted-foreground mb-4 text-sm [text-wrap:pretty]">
                        {{
                            results.type === 'wake'
                                ? 'These wake times are based on completing full sleep cycles:'
                                : 'These bedtimes are based on waking up at your desired time:'
                        }}
                    </p>

                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                        <Card
                            v-for="(time, index) in results.times"
                            :key="index"
                            :class="`relative rounded-xl shadow-[0_1px_1px_rgba(0,0,0,0.04),0_8px_24px_rgba(12,16,28,0.08)] ring-1 ring-black/5 dark:ring-white/10 ${(results.type === 'wake' ? index === 4 : index === 1) ? 'border-primary border-2' : ''}`"
                        >
                            <p
                                v-if="(results.type === 'wake' && index === 4) || (results.type === 'sleep' && index === 1)"
                                class="bg-card text-primary absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full px-2 py-0.5 text-xs font-medium"
                            >
                                Recommended
                            </p>
                            <CardContent class="p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-muted-foreground text-xs">
                                            {{
                                                results.type === 'wake'
                                                    ? `${index + 1} cycle${index !== 0 ? 's' : ''}`
                                                    : `${6 - index} cycle${6 - index !== 1 ? 's' : ''}`
                                            }}
                                        </p>
                                        <p
                                            :class="`text-xl font-bold tabular-nums ${(results.type === 'wake' ? index === 4 : index === 1) ? 'text-primary' : ''}`"
                                        >
                                            {{ formatTime(time) }}
                                        </p>
                                        <p class="text-muted-foreground text-xs tabular-nums">
                                            {{ results.type === 'sleep' ? calculateSleepHours(6 - index) : calculateSleepHours(index + 1) }}
                                            hours of sleep
                                        </p>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    <div class="bg-muted/70 mt-6 rounded-xl p-4 ring-1 ring-black/5 dark:ring-white/10">
                        <h4 class="mb-2 text-sm font-semibold">About Sleep Cycles</h4>
                        <p class="text-muted-foreground text-xs [text-wrap:pretty]">
                            Sleep cycles usually last around 90 minutes. Waking up at the end of a cycle, instead of in the middle of one, helps you
                            feel more refreshed.
                        </p>
                        <p v-if="timeToFallAsleep !== 15" class="text-muted-foreground mt-2 text-xs [text-wrap:pretty]">
                            {{ appName }} has taken into account your {{ timeToFallAsleep }} minutes to fall asleep.
                        </p>
                        <p v-else class="text-muted-foreground mt-2 text-xs [text-wrap:pretty]">
                            {{ appName }} adds 15 minutes to account for the average time it takes people to fall asleep.
                        </p>
                    </div>
                </div>
            </Transition>
        </CardContent>
    </Card>
</template>
