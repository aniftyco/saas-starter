<script setup lang="ts">
type Variants = 'primary' | 'secondary' | 'danger';

export type Props = {
  variant?: Variants;
};

const props = withDefaults(defineProps<Props>(), {
  variant: 'primary',
});
</script>
<template>
  <button
    v-bind="$attrs"
    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"
    :class="{
      'bg-primary-600 text-white hover:bg-primary-700 focus:bg-primary-800 active:bg-primary-900 focus:ring-primary-500':
        props.variant === 'primary',
      'bg-white dark:bg-background-800 border-background-300 dark:border-background-600 text-background-700 dark:text-background-100 hover:bg-background-50 dark:hover:bg-background-900 focus:ring-primary-500':
        props.variant === 'secondary',
      'bg-danger-600 text-white hover:bg-danger-700 focus:bg-danger-800 active:bg-danger-900 focus:ring-danger-500':
        props.variant === 'danger',
    }"
  >
    <slot />
  </button>
</template>
