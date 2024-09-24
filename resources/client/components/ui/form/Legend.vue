<script setup lang="ts">
import { clsx } from '@app/utils';
</script>

<template>
  <legend
    data-slot="legend"
    :class="
      clsx(
        $attrs.class,
        'text-base/6 font-semibold text-zinc-950 data-[disabled]:opacity-50 sm:text-sm/6 dark:text-white'
      )
    "
  >
    <slot />
  </legend>
</template>
