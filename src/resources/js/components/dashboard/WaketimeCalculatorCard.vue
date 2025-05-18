<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Sun } from 'lucide-vue-next';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { type SharedData, type User } from '@/types';

const page = usePage<SharedData>();
const user = page.props.auth.user as User;
const timeToFallAsleep = user.sleep_preferences?.fall_asleep_time ?? 15;

const hourOptions = Array.from({ length: 12 }, (_, i) => i + 1);
const minuteOptions = Array.from({ length: 12 }, (_, i) => i * 5);

const bedTime = ref({
    hour: '11',
    minute: '00',
    ampm: 'PM'
});

const results = ref<Date[]>([]);

const calculateWakeTimes = () => {
    const now = new Date();
    now.setHours(parseInt(bedTime.value.hour) + (bedTime.value.ampm === 'PM' ? 12 : 0));
    now.setMinutes(parseInt(bedTime.value.minute) + timeToFallAsleep);

    const wakeTimes = Array.from({ length: 4 }, (_, i) => {
        const wakeTime = new Date(now);
        const cycles = i + 3;
        wakeTime.setMinutes(wakeTime.getMinutes() + cycles * 90);
        return wakeTime;
    });

    results.value = wakeTimes;
};

const formatTime = (date: Date): string => {
    const options: Intl.DateTimeFormatOptions = {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true,
    };
    return date.toLocaleString('en-US', options);
};

const getSleepHours = (cycles: number): string => {
    return ((cycles * 90) / 60).toFixed(1);
};

const getHighlightClass = (cycles: number): string => {
    if (cycles === 5) return 'bg-green-500 text-white border-green-500';
    if (cycles === 6) return 'bg-green-100 text-green-900 border-green-200';
    return '';
};

const sleepNow = () => {
    const now = new Date();
    const hours = now.getHours();
    let displayHours = hours % 12;
    if (displayHours === 0) displayHours = 12;

    const minutes = now.getMinutes();
    const roundedMinutes = Math.round(minutes / 5) * 5;
    const formattedMinutes = (roundedMinutes % 60).toString().padStart(2, '0');

    bedTime.value = {
        hour: displayHours.toString(),
        minute: formattedMinutes,
        ampm: hours >= 12 ? 'PM' : 'AM'
    };

    calculateWakeTimes();
};
</script>

<template>
    <Card class="h-full flex flex-col">
        <CardContent class="flex flex-col h-full p-4">
            <div class="flex items-center gap-2 mb-2">
                <div class="h-8 w-8 bg-primary rounded-full flex items-center justify-center text-white">
                    <Sun class="h-4 w-4" />
                </div>
                <h3 class="text-sm font-semibold">When should I wake up?</h3>
            </div>

            <div v-if="!results.length" class="flex flex-col flex-1">
                <p class="text-xs text-muted-foreground mb-3">
                    Enter your bedtime to see the best times to wake up for optimal sleep.
                </p>
                <div class="flex items-end gap-1 mb-3">
                    <div class="flex-1">
                        <Label for="bed-hour" class="text-xs">Sleep at</Label>
                        <div class="flex gap-1">
                            <select id="bed-hour" v-model="bedTime.hour"
                                class="flex-1 h-8 text-xs rounded-md border px-1 border-input bg-background ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                <option v-for="hour in hourOptions" :key="hour" :value="hour">{{ hour }}</option>
                            </select>
                            <select id="bed-minute" v-model="bedTime.minute"
                                class="flex-1 h-8 text-xs rounded-md border px-1 border-input bg-background ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                <option v-for="minute in minuteOptions" :key="minute"
                                    :value="minute.toString().padStart(2, '0')">
                                    {{ minute.toString().padStart(2, '0') }}
                                </option>
                            </select>
                            <select id="bed-ampm" v-model="bedTime.ampm"
                                class="flex-1 h-8 text-xs rounded-md border px-1 border-input bg-background ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                    <Button @click="calculateWakeTimes()" size="sm" class="h-8">Calculate</Button>
                </div>
                <Button @click="sleepNow()" variant="outline" size="sm" class="mb-3">Sleep Now</Button>

                <div class="mt-auto hidden 2xl:flex items-center gap-2 py-2 px-3 bg-muted/50 rounded-lg">
                    <div class="h-10 w-10 rounded-full flex items-center justify-center bg-primary/10 text-primary">
                        <Sun class="h-5 w-5" />
                    </div>
                    <div class="text-xs">
                        <p class="font-medium">Sleep cycles matter</p>
                        <p class="text-muted-foreground">Complete cycles help you wake up feeling refreshed</p>
                    </div>
                </div>
            </div>

            <div v-else class="flex-1 flex flex-col">
                <p class="text-xs text-muted-foreground mb-2">
                    If you sleep at {{ bedTime.hour }}:{{ bedTime.minute }} {{ bedTime.ampm }}, wake up at:
                </p>
                <div class="grid grid-cols-2 gap-2">
                    <div v-for="(time, index) in results" :key="index" class="border rounded p-2 text-center"
                        :class="getHighlightClass(index + 3)">
                        <p class="text-lg font-semibold">{{ formatTime(time) }}</p>
                        <p class="text-xs">{{ getSleepHours(index + 3) }} hours</p>
                    </div>
                </div>
                <div class="mt-auto flex justify-between items-center">
                    <div class="flex flex-col gap-1 text-xs text-muted-foreground mt-3">
                        <div class="flex items-center gap-1">
                            <div class="w-3 h-3 bg-green-500 rounded"></div>
                            <span>7.5 hours - Optimal for most adults</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <div class="w-3 h-3 bg-green-100 rounded"></div>
                            <span>9 hours - Recommended for teens/recovery</span>
                        </div>
                    </div>
                    <Button @click="results = []" variant="outline" size="sm" class="text-xs">Calculate Again</Button>
                </div>
            </div>
        </CardContent>
    </Card>
</template>
