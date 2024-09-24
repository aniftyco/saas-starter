<script setup lang="ts">
export type Props = {
  on: boolean;
};

const props = defineProps<Props>();
</script>

<template>
  <div>
    <transition
      leave-active-class="transition ease-in duration-1000"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div v-show="props.on" class="text-sm font-semibold text-green-600 dark:text-green-400">
        <slot />
      </div>
    </transition>
  </div>
</template>
