<script setup lang="ts">
import { clsx } from '@app/utils';
</script>

<template>
  <p
    data-slot="description"
    :class="clsx($attrs.class, 'text-base/6 text-zinc-500 data-[disabled]:opacity-50 sm:text-sm/6 dark:text-zinc-400')"
  >
    <slot />
  </p>
</template>
