<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { Label } from "@/components/ui/label";
import { ref } from 'vue';
import { Sun, Moon } from "lucide-vue-next";

const emit = defineEmits(['submit']);

// Generate options for hour, minute, am/pm selects
const hourOptions = Array.from({ length: 12 }, (_, i) => i + 1);
const minuteOptions = Array.from({ length: 12 }, (_, i) => i * 5);

const formData = ref({
    hour: '11',
    minute: '00',
    ampm: 'PM'
});

const handleSubmit = (e: Event) => {
    e.preventDefault();
    emit('submit', formData.value);
};

const sleepNow = () => {
    const now = new Date();
    const hours = now.getHours();
    let displayHours = hours % 12;
    if (displayHours === 0) displayHours = 12;

    const minutes = now.getMinutes() + 5; // add extra 5min cause user still needs to get ready probably
    const roundedMinutes = Math.round(minutes / 5) * 5;
    const formattedMinutes = (roundedMinutes % 60).toString().padStart(2, '0');

    formData.value = {
        hour: displayHours.toString(),
        minute: formattedMinutes,
        ampm: hours >= 12 ? 'PM' : 'AM'
    };

    emit('submit', formData.value);
};
</script>

<template>
    <form @submit="handleSubmit" class="space-y-4">
        <div class="text-center mb-4">
            <div class="inline-block">
                <div class="h-14 w-14 bg-primary rounded-full flex items-center justify-center text-white">
                    <Sun class="h-8 w-8" />
                </div>
            </div>
            <p class="text-center text-muted-foreground max-w-md mx-auto mt-2">
                Enter the time you want to go to sleep, and we'll calculate the best times to wake up.
            </p>
        </div>

        <div class="flex items-center justify-center gap-2">
            <div class="space-y-2">
                <Label for="hour">Hour</Label>
                <select id="hour" v-model="formData.hour"
                    class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    <option v-for="hour in hourOptions" :key="hour" :value="hour">
                        {{ hour }}
                    </option>
                </select>
            </div>
            <div class="space-y-2">
                <Label for="minute">Minute</Label>
                <select id="minute" v-model="formData.minute"
                    class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    <option v-for="minute in minuteOptions" :key="minute" :value="minute.toString().padStart(2, '0')">
                        {{ minute.toString().padStart(2, '0') }}
                    </option>
                </select>
            </div>
            <div class="space-y-2">
                <Label for="ampm">AM/PM</Label>
                <select id="ampm" v-model="formData.ampm"
                    class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <Button type="submit" size="lg" class="w-full">
                Calculate Waketime
            </Button>
            <Button type="button" size="lg" class="w-full" variant="outline" @click="sleepNow">
                <Moon class="mr-2 h-4 w-4" />
                Sleep Now
            </Button>
        </div>
    </form>
</template>
