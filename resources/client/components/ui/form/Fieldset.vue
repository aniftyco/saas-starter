<script setup lang="ts">
import { clsx } from '@app/utils';
</script>

<template>
  <fieldset v-bind:class="clsx($attrs.class, '[&>*+[data-slot=control]]:mt-6 [&>[data-slot=text]]:mt-1')">
    <slot />
  </fieldset>
</template>
