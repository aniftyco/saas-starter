<script setup lang="ts">
import { clsx } from '@app/utils';
</script>

<template>
  <div
    :class="
      clsx(
        $attrs.class,
        '[&>[data-slot=label]+[data-slot=control]]:mt-3',
        '[&>[data-slot=label]+[data-slot=description]]:mt-1',
        '[&>[data-slot=description]+[data-slot=control]]:mt-3',
        '[&>[data-slot=control]+[data-slot=description]]:mt-3',
        '[&>[data-slot=control]+[data-slot=error]]:mt-3',
        '[&>[data-slot=label]]:font-medium'
      )
    "
  >
    <slot />
  </div>
</template>
