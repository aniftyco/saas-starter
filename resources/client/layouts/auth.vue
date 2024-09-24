<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import Logo from '@app/components/Logo.vue';

type PageProps = {
  appName: string;
};

const { props } = usePage<PageProps>();
</script>

<template>
  <div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-background-100 dark:bg-background-900"
  >
    <a :href="route('home')" class="flex flex-col items-center gap-2">
      <Logo size="xl" />
      <span class="text-3xl font-semibold text-primary-600">{{ props.appName }}</span>
    </a>

    <div
      class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-background-800 shadow-md overflow-hidden sm:rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>
