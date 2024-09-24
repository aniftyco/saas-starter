<script setup lang="ts">
import { PageHeader } from '@app/components/ui';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard" />
  <PageHeader>Dashboard</PageHeader>

  <main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-background-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div
          class="p-6 lg:p-8 bg-white dark:bg-background-800 dark:bg-gradient-to-bl dark:from-background-700/50 dark:via-transparent border-b border-background-200 dark:border-background-700"
        >
          <h1 class="text-2xl font-medium text-background-900 dark:text-white">Welcome to your new application!</h1>

          <p class="mt-6 text-background-500 dark:text-background-400 leading-relaxed">
            This is a starter template for a fullstack application using Laravel and Vue.js.
          </p>
        </div>
      </div>
    </div>
  </main>
</template>
