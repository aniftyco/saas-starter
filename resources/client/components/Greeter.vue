<script setup lang="ts">
defineProps<{ message: string }>();
</script>
<template>
  <h1 v-text="message" />
</template>
