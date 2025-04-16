<script setup lang="ts">
import { SharedData } from '@/types';
import { Head } from '@inertiajs/vue3';

import Header from '@/components/Header.vue';
import Hero from '@/components/Hero.vue';
import HowItWorks from '@/components/HowItWorks.vue';
import CTA from '@/components/CTA.vue';

const props = defineProps<SharedData>();
</script>

<template>

    <Head title="Home">

    </Head>
    <div class="flex min-h-screen flex-col">
        <Header :appName="props.name" :auth="props.auth" />
        <Hero :appName="props.name"/>
        <HowItWorks :appName="props.name" />
        <CTA />

    </div>

</template>
