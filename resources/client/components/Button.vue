<script setup lang="ts">
withDefaults(defineProps<{ variant?: 'primary' | 'subtle' }>(), {
  variant: 'primary',
});
</script>
<template>
  <button
    v-bind="$attrs"
    :class="{
      'rounded-md bg-primary-600 flex items-center px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus:outline-none':
        variant === 'primary',
      'text-gray-500 hover:text-gray-600 hover:bg-gray-100 px-3 py-2 text-sm font-semibold rounded-md':
        variant === 'subtle',
    }"
  >
    <slot />
  </button>
</template>
