<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Greeter from '../components/Greeter.vue';

const { props } = usePage<{ name: string }>();

const message = computed(() => `Hello, ${props.name}!`);
</script>
<template>
  <Greeter :message="message" />
</template>
