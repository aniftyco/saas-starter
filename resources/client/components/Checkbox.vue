<script setup lang="ts">
defineProps<{ label: string; modelValue?: any }>();
defineEmits(['update:modelValue']);
</script>
<template>
  <div class="mb-2">
    <label class="flex items-center space-x-2">
      <input
        :value="modelValue"
        @change="$emit('update:modelValue', ($event.target as HTMLInputElement).checked)"
        type="checkbox"
        class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-0"
      />
      <span class="text-sm">{{ label }}</span>
    </label>
  </div>
</template>
