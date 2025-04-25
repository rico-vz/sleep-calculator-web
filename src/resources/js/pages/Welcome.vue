<script setup lang="ts">
import { SharedData } from '@/types';
import { Head } from '@inertiajs/vue3';

import Header from '@/components/Header.vue';
import Hero from '@/components/Hero.vue';
import HowItWorks from '@/components/HowItWorks.vue';
import CTA from '@/components/CTA.vue';
import Footer from '@/components/Footer.vue';

const props = defineProps<SharedData>();
</script>

<template>

    <Head>
        <!-- Generic -->
        <title>Home</title>
        <meta name="description" content="Optimize your sleep with SleepUtility. Calculate the best times to fall asleep and wake up based on sleep cycles." />

        <!-- Search Engine -->
        <meta itemprop="name" content="SleepUtility" />
        <meta itemprop="description" content="Optimize your sleep with SleepUtility. Calculate the best times to fall asleep and wake up based on sleep cycles." />

        <!-- OpenGraph -->
        <meta property="og:url" content="https://sleeputility.com/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="SleepUtility" />
        <meta property="og:description" content="Optimize your sleep with SleepUtility. Calculate the best times to fall asleep and wake up based on sleep cycles." />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="SleepUtility" />
        <meta name="twitter:description" content="Optimize your sleep with SleepUtility. Calculate the best times to fall asleep and wake up based on sleep cycles." />
    </Head>
    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <Hero :appName="props.name" :time-to-fall-asleep="props.sleepPreferences.fall_asleep_time"/>
        <HowItWorks :appName="props.name" />
        <CTA />
        <Footer :appName="props.name" />

    </div>

</template>
