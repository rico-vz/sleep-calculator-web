<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :class="className" v-bind="$attrs" src="/img/sleeputility-logo-transparent.png" alt="SleepUtility Logo" />
</template>
