<script setup lang="ts">
import { computed, useSlots } from 'vue';
import SectionTitle from '@root/resources/client/components/ui/SectionTitle.vue';

export type Emits = {
  submitted: [];
};

const emit = defineEmits<Emits>();

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <SectionTitle>
      <template #title>
        <slot name="title" />
      </template>
      <template #description>
        <slot name="description" />
      </template>
    </SectionTitle>

    <div class="mt-5 md:mt-0 md:col-span-2">
      <form @submit.prevent="emit('submitted')">
        <div
          class="px-4 py-5 bg-white dark:bg-background-800 sm:p-6 shadow"
          :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
        >
          <div class="grid grid-cols-6 gap-6">
            <slot name="form" />
          </div>
        </div>

        <div
          v-if="hasActions"
          class="flex items-center justify-end px-4 py-3 bg-background-50 dark:bg-background-800/50 shadow sm:rounded-bl-md sm:rounded-br-md"
        >
          <slot name="actions" />
        </div>
      </form>
    </div>
  </div>
</template>
