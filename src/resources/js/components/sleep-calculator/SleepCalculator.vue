<script setup lang="ts">
import { ref, watch } from 'vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import CalculateBedTime from './CalculateBedTime.vue';
import CalculateWakeTime from './CalculateWakeTime.vue';
import { Moon, Sun } from 'lucide-vue-next';
import { Button } from "@/components/ui/button";

interface ResultsType {
    times: Date[];
    type: "wake" | "sleep";
}

const props = defineProps({
    appName: String,
    timeToFallAsleep: {
        type: Number,
        default: 15
    }
});

const activeTab = ref("calculate-bed-time");
const results = ref<ResultsType | null>(null);

watch(activeTab, () => {
    results.value = null;
});

const handleCalculateBedTime = (formData: any) => {
    const wakeTime = new Date();
    wakeTime.setHours(parseInt(formData.hour) + (formData.ampm === 'PM' ? 12 : 0));
    wakeTime.setMinutes(parseInt(formData.minute));
    const bedTimes = Array.from({ length: 6 }, (_, i) => {
        const bedTime = new Date(wakeTime);
        bedTime.setMinutes(bedTime.getMinutes() - (i + 1) * 90 - props.timeToFallAsleep);
        return bedTime;
    }).reverse();
    results.value = { times: bedTimes, type: "sleep" };
};

const handleWakeTimeSubmit = (formData: any) => {
    const sleepTime = new Date();
    sleepTime.setHours(parseInt(formData.hour) + (formData.ampm === 'PM' ? 12 : 0));
    sleepTime.setMinutes(parseInt(formData.minute) + props.timeToFallAsleep);
    const wakeTimes = Array.from({ length: 6 }, (_, i) => {
        const wakeTime = new Date(sleepTime);
        wakeTime.setMinutes(wakeTime.getMinutes() + (i + 1) * 90);
        return wakeTime;
    });
    results.value = { times: wakeTimes, type: "wake" };
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
    const totalMinutes = (cycles * 90);
    const hours = Math.floor(totalMinutes / 60);
    const minutes = totalMinutes % 60;
    return (hours + (minutes / 60)).toFixed(1).replace(/\.0$/, '');
};
</script>

<template>
    <Card class="w-full max-w-3xl mx-auto p-6 pt-0">
        <CardHeader class="space-y-1 text-center p-6">
            <CardTitle class="text-2xl font-bold ">
                {{ appName }} Calculator
            </CardTitle>
            <CardDescription>
                Calculate optimal sleep and wake times based on sleep cycles
            </CardDescription>
        </CardHeader>
        <CardContent>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <Button
                    @click="activeTab = 'calculate-bed-time'"
                    :variant="activeTab === 'calculate-bed-time' ? 'default' : 'outline'"
                    class="space-x-2 w-full"
                >
                    <Moon class="h-4 w-4" />
                    <span>Calculate bed time</span>
                </Button>
                <Button
                    @click="activeTab = 'calculate-wake-time'"
                    :variant="activeTab === 'calculate-wake-time' ? 'default' : 'outline'"
                    class="space-x-2 w-full"
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

            <Transition enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 transform -translate-y-4"
                enter-to-class="opacity-100 transform translate-y-0"
                leave-active-class="transition-all duration-200 ease-in" leave-from-class="opacity-100"
                leave-to-class="opacity-0 transform -translate-y-4">
                <div v-if="results" class="mt-8 pt-6 border-t">
                    <h3 class="text-lg font-semibold mb-4 ">
                        {{ results.type === "wake" ? "Optimal Wake-Up Times" : "Optimal Bedtimes" }}
                    </h3>
                    <p class="text-sm text-muted-foreground mb-4">
                        {{ results.type === "wake"
                            ? "These wake times are based on completing full sleep cycles:"
                            : "These bedtimes are based on waking up at your desired time:" }}
                    </p>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <Card v-for="(time, index) in results.times" :key="index"
                            :class="`overflow-hidden ${(results.type === 'wake' ? index === 4 : index === 1) ? 'border-primary border-2' : ''}`">
                            <CardContent class="p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs text-muted-foreground">
                                            {{ results.type === "wake"
                                                ? `${index + 1} cycle${index !== 0 ? 's' : ''}`
                                                : `${6 - index} cycle${6 - index !== 1 ? 's' : ''}` }}
                                        </p>
                                        <p
                                            :class="`text-xl font-bold ${(results.type === 'wake' ? index === 4 : index === 1) ? 'text-primary' : ''}`">
                                            {{ formatTime(time) }}
                                        </p>
                                        <p class="text-xs text-muted-foreground">
                                            {{ results.type === "sleep"
                                                ? calculateSleepHours(6 - index)
                                                : calculateSleepHours(index + 1) }}
                                            hours of sleep
                                        </p>
                                    </div>
                                </div>
                                <p v-if="results.type === 'wake' && index === 4 || results.type === 'sleep' && index === 1"
                                    class="text-xs mt-2 text-primary-foreground bg-primary px-1.5 py-0.5 rounded-sm font-medium inline-block">
                                    Recommended
                                </p>
                            </CardContent>
                        </Card>
                    </div>

                    <div class="mt-6 p-4 bg-muted rounded-lg">
                        <h4 class="font-semibold text-sm mb-2">About Sleep Cycles</h4>
                        <p class="text-xs text-muted-foreground">
                            Sleep cycles usually last around 90 minutes. Waking up at the end of a cycle, instead of in
                            the
                            middle onf one,
                            helps you feel more refreshed.
                        </p>
                        <p v-if="timeToFallAsleep !== 15" class="text-xs text-muted-foreground mt-2">
                            {{ appName }} has taken into account your {{ timeToFallAsleep }} minutes to fall asleep.
                        </p>
                        <p v-else class="text-xs text-muted-foreground mt-2">
                            {{ appName }} adds 15 minutes to account for the average time it takes people to fall
                            asleep.
                        </p>
                    </div>
                </div>
            </Transition>
        </CardContent>
    </Card>
</template>
