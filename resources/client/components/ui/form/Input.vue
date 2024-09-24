<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { clsx } from '@app/utils';

defineOptions({ inheritAttrs: false });
defineExpose({ focus: () => input.value?.focus() });

const input = ref(null);
const value = defineModel();

onMounted(() => {
  if (input.value?.hasAttribute('autofocus')) {
    input.value.focus();
  }
});
</script>

<template>
  <span
    data-slot="control"
    v-bind:class="
      clsx(
        $attrs.class,
        // Basic layout
        'relative block w-full',
        // Background color + shadow applied to inset pseudo element, so shadow blends with border in light mode
        'before:absolute before:inset-px before:rounded-[calc(theme(borderRadius.lg)-1px)] before:bg-white before:shadow',
        // Background color is moved to control and shadow is removed in dark mode so hide `before` pseudo
        'dark:before:hidden',
        // Focus ring
        'after:pointer-events-none after:absolute after:inset-0 after:rounded-lg after:ring-inset after:ring-transparent sm:after:focus-within:ring-2 sm:after:focus-within:ring-primary-500',
        // Disabled state
        'has-[[data-disabled]]:opacity-50 before:has-[[data-disabled]]:bg-background-950/5 before:has-[[data-disabled]]:shadow-none',
        // Invalid state
        'before:has-[[data-invalid]]:shadow-red-500/10'
      )
    "
  >
    <input
      ref="input"
      v-bind="$attrs"
      v-bind:id="$attrs.name as string"
      v-bind:data-invalid="$attrs.invalid"
      v-bind:data-disabled="$attrs.disabled"
      v-model="value"
      v-bind:class="
        clsx(
          // Basic layout
          'relative block w-full appearance-none rounded-md px-[calc(theme(spacing[4])-1px)] py-[calc(theme(spacing[3])-1px)] sm:px-[calc(theme(spacing[3])-1px)] sm:py-[calc(theme(spacing[2])-1px)]',
          // Typography
          'text-background-950 placeholder:text-background-500 dark:text-background-300',
          // Border
          'border border-background-300 dark:border-background-700',
          // Background color
          'bg-transparent dark:bg-background-900',
          // Hide default focus styles
          'focus:outline-none focus:ring-background-900',
          // Invalid state
          'data-[invalid]:border-red-500 data-[invalid]:dark:border-red-500',
          // Disabled state
          'data-[disabled]:border-background-950/20 data-[disabled]:dark:border-white/15 data-[disabled]:dark:bg-white/[2.5%] data-[disabled]:cursor-not-allowed',
          // System icons
          'dark:[color-scheme:dark]'
        )
      "
    />
  </span>
</template>
