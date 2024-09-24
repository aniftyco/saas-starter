<script setup lang="ts">
import { clsx } from '@app/utils';
</script>

<template>
  <div data-slot="control" :class="clsx($attrs.class, 'space-y-8')">
    <slot />
  </div>
</template>
