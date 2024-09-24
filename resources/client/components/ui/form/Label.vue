<script setup lang="ts">
import { clsx } from '@app/utils';
</script>

<template>
  <label
    data-slot="label"
    :class="clsx($attrs.class, 'select-none text-zinc-950 data-[disabled]:opacity-50 dark:text-white')"
  >
    <slot />
  </label>
</template>
