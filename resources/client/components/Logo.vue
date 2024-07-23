<script setup lang="ts">
withDefaults(defineProps<{ size?: 'sm' | 'md' | 'lg' }>(), {
  size: 'md',
});
</script>
<template>
  <a
    class="flex select-none items-end space-x-1"
    :class="{
      'text-xl': size === 'sm',
      'text-2xl': size === 'md',
      'text-3xl': size === 'lg',
    }"
    href="/"
  >
    <span class="mr-1 pb-0.5 font-semibold text-gray-900">NIFTY</span>
    <span class="from-primary-600 rounded-lg bg-gradient-to-l to-indigo-600 px-1.5 py-0.5 font-semibold text-white"
      >SaaS</span
    >
  </a>
</template>
