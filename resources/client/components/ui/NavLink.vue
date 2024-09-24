<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { clsx } from '@app/utils';

export type Props = {
  href: string;
  active: boolean;
};

const props = defineProps<Props>();
</script>

<template>
  <Link
    :href="props.href"
    v-bind:class="
      clsx('inline-flex items-center px-3 py-2', 'rounded-md', 'text-sm font-medium leading-5', 'focus:outline-none', {
        'bg-background-transparent hover:bg-background-100 text-background-500 hover:text-background-700':
          !props.active,
        'dark:hover:bg-background-700 dark:text-background-400 dark:hover:text-background-300': !props.active,

        'bg-background-200 text-background-500 hover:text-background-700': props.active,
        'dark:bg-background-700/90 dark:text-background-300 dark:hover:text-background-200': props.active,
      })
    "
  >
    <slot />
  </Link>
</template>
