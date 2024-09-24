<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

export type Props = {
  active?: boolean;
  href?: string;
  as?: 'a' | 'button';
};

const props = defineProps<Props>();

const classes = computed(() => {
  return props.active
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-primary-400 dark:border-primary-600 text-start text-base font-medium text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/50 focus:outline-none focus:text-primary-800 dark:focus:text-primary-200 focus:bg-primary-100 dark:focus:bg-primary-900 focus:border-primary-700 dark:focus:border-primary-300 transition duration-150 ease-in-out'
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-background-600 dark:text-background-400 hover:text-background-800 dark:hover:text-background-200 hover:bg-background-50 dark:hover:bg-background-700 hover:border-background-300 dark:hover:border-background-600 focus:outline-none focus:text-background-800 dark:focus:text-background-200 focus:bg-background-50 dark:focus:bg-background-700 focus:border-background-300 dark:focus:border-background-600 transition duration-150 ease-in-out';
});
</script>

<template>
  <div>
    <button v-if="props.as == 'button'" class="w-full text-start" :class="classes">
      <slot />
    </button>

    <Link v-else :href="props.href" :class="classes">
      <slot />
    </Link>
  </div>
</template>
