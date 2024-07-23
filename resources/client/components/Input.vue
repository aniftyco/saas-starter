<script setup lang="ts">
withDefaults(
  defineProps<{
    label?: string;
    modelValue?: any;
    type?: 'text' | 'password';
    error?: false | string;
  }>(),
  {
    modelValue: '',
    type: 'text',
    error: false,
  }
);
defineEmits(['update:modelValue']);
</script>
<template>
  <div class="mb-2">
    <span v-if="label" class="block text-sm font-semibold leading-6 text-gray-900 after:[content:':']">
      {{ label }}
    </span>
    <div class="mt-1">
      <input
        :value="modelValue"
        @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        :type="type"
        class="block w-full rounded-md shadow-sm px-2 py-1.5 border-1 focus:ring-0 border-gray-300 text-gray-900 placeholder:text-gray-400 focus:border-primary-500"
        :class="{
          'border-red-300 text-red-900 placeholder:text-red-400 focus:border-red-600': error,
        }"
      />
    </div>
    <p v-if="error" v-text="error" class="text-red-600 text-xs mt-0.5" />
  </div>
</template>
