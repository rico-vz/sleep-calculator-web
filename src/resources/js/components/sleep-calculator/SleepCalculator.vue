<script setup lang="ts">
import { ref } from 'vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import CalculateBedTime from './CalculateBedTime.vue';
import CalculateWakeTime from './CalculateWakeTime.vue';

interface ResultsType {
    times: Date[];
    type: "wake" | "sleep";
}

defineProps({
    appName: String
});

const activeTab = ref("calculate-bed-time");
const results = ref<ResultsType | null>(null);

// Placeholder for bed time calculation
const handleCalculateBedTime = () => {
    // Note: Real implementation would be added here
    const fakeTimes = Array(6).fill(null).map(() => new Date());
    results.value = { times: fakeTimes, type: "sleep" };
};

// Placeholder for wake time calculation
const handleWakeTimeSubmit = (formData: any) => {
    // Note: Real implementation would be added here
    const fakeTimes = Array(6).fill(null).map(() => new Date());
    results.value = { times: fakeTimes, type: "wake" };
};

// Placeholder function for formatting time
const formatTime = (date: Date): string => {
    return "12:00 AM"; // Placeholder - would be implemented in real app
};
</script>

<template>
    <Card class="w-full max-w-3xl mx-auto">
        <CardHeader class="space-y-1 text-center">
            <CardTitle class="text-2xl font-bold font-montserrat">
                {{ appName }} Calculator
            </CardTitle>
            <CardDescription>
                Calculate optimal sleep and wake times based on sleep cycles
            </CardDescription>
        </CardHeader>
        <CardContent>
            <Tabs v-model="activeTab" default-value="calculate-bed-time">
                <TabsList class="grid grid-cols-2 mb-6">
                    <TabsTrigger value="calculate-bed-time" class="space-x-2">
                        <!-- Icon placeholder -->
                        <span>Calculate bed time</span>
                    </TabsTrigger>
                    <TabsTrigger value="calculate-wake-time" class="space-x-2">
                        <!-- Icon placeholder -->
                        <span>Calculate wake time</span>
                    </TabsTrigger>
                </TabsList>

                <TabsContent value="calculate-bed-time" class="space-y-4">
                    <CalculateBedTime @submit="handleCalculateBedTime" />
                </TabsContent>

                <TabsContent value="calculate-wake-time">
                    <CalculateWakeTime @submit="handleWakeTimeSubmit" />
                </TabsContent>
            </Tabs>

            <div v-if="results" class="mt-8 pt-6 border-t">
                <h3 class="text-lg font-semibold mb-4 font-montserrat">
                    {{ results.type === "wake" ? "Optimal Wake-Up Times" : "Optimal Bedtimes" }}
                </h3>
                <p class="text-sm text-muted-foreground mb-4">
                    {{ results.type === "wake"
                        ? "These wake times are based on completing full sleep cycles:"
                        : "These bedtimes are based on waking up at your desired time:" }}
                </p>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <Card v-for="(time, index) in results.times" :key="index"
                        :class="`overflow-hidden ${index === 4 ? 'border-primary border-2' : ''}`">
                        <CardContent class="p-4">
                            <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <p :class="`text-xl font-bold ${index === 4 ? 'text-primary' : ''}`">
                                        {{ formatTime(time) }}
                                    </p>
                                    <p class="text-xs text-muted-foreground">
                                        {{ results.type === "wake"
                                            ? `${index + 1} cycle${index !== 0 ? 's' : ''}`
                                            : `${6 - index} cycle${6 - index !== 1 ? 's' : ''}` }}
                                    </p>
                                </div>
                                <!-- Icon placeholder -->
                            </div>
                            <p v-if="index === 4"
                                class="text-xs mt-2 text-primary-foreground bg-primary px-1.5 py-0.5 rounded-sm font-medium inline-block">
                                Recommended
                            </p>
                        </CardContent>
                    </Card>
                </div>

                <div class="mt-6 p-4 bg-muted rounded-lg">
                    <h4 class="font-semibold text-sm mb-2">About Sleep Cycles</h4>
                    <p class="text-xs text-muted-foreground">
                        Sleep cycles typically last 90 minutes. Waking up at the end of a cycle, rather than in the
                        middle,
                        helps you feel more refreshed. This calculator adds 14 minutes to account for the average time
                        it
                        takes to fall asleep.
                    </p>
                </div>
            </div>
        </CardContent>
    </Card>
</template>
