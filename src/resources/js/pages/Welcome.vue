<script setup lang="ts">
import { SharedData } from '@/types';

import CTA from '@/components/CTA.vue';
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import Hero from '@/components/Hero.vue';
import HowItWorks from '@/components/HowItWorks.vue';
import SeoHead from '@/components/SeoHead.vue';
import { webApplicationSchema } from '@/lib/seo';

const props = defineProps<SharedData>();
const description = 'Optimize your sleep with SleepUtility. Calculate the best times to fall asleep and wake up based on sleep cycles.';
</script>

<template>
    <SeoHead
        :title="props.name"
        :description="description"
        :canonical="route('home')"
        :schemas="[webApplicationSchema(props.name, route('home'), description)]"
    />
    <div class="bg-background relative isolate flex min-h-screen flex-col overflow-x-clip">
        <div
            class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[clamp(30rem,42vw,56rem)] bg-[radial-gradient(ellipse_140%_85%_at_50%_-18%,color-mix(in_srgb,var(--primary)_18%,transparent),transparent_75%)]"
        />
        <Header :appName="props.name" :auth="props.auth" />
        <Hero :appName="props.name" :time-to-fall-asleep="props.sleepPreferences.fall_asleep_time" />
        <HowItWorks :appName="props.name" />
        <CTA />
        <Footer :appName="props.name" />
    </div>
</template>
