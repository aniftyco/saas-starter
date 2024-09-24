<script setup lang="ts">
import { clsx } from '@app/utils';
</script>

<template>
  <p
    data-slot="error"
    :class="clsx($attrs.class, 'text-base/6 text-red-600 data-[disabled]:opacity-50 sm:text-sm/6 dark:text-red-500')"
  >
    <slot />
  </p>
</template>
