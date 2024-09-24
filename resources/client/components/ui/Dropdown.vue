<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

export type Props = {
  align?: 'left' | 'right';
  size?: 'sm' | 'md' | 'lg' | 'auto';
};

const props = withDefaults(defineProps<Props>(), {
  align: 'right',
  size: 'md',
});

const open = ref(false);

const closeOnEscape = (e: KeyboardEvent) => {
  if (open.value && e.key === 'Escape') {
    open.value = false;
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));
</script>

<template>
  <div class="relative">
    <span @click="open = !open">
      <slot name="trigger" />
    </span>

    <!-- Full Screen Dropdown Overlay -->
    <div v-show="open" class="fixed inset-0 z-40" @click="open = false" />

    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-show="open"
        class="absolute z-50 mt-2 rounded-md shadow-lg"
        :class="{
          // Width
          'w-32': props.size === 'sm',
          'w-48': props.size === 'md',
          'w-64': props.size === 'lg',
          'w-auto': props.size === 'auto',
          // Alignment
          'ltr:origin-top-left rtl:origin-top-right start-0': props.align === 'left',
          'ltr:origin-top-right rtl:origin-top-left end-0': props.align === 'right',
        }"
        style="display: none"
        @click="open = false"
      >
        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white dark:bg-background-700">
          <slot name="content" />
        </div>
      </div>
    </transition>
  </div>
</template>
