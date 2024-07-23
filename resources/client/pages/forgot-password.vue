<script setup lang="ts">
import { useForm, Head } from '@inertiajs/vue3';
import Logo from '@app/components/Logo.vue';
import Input from '@app/components/Input.vue';
import Button from '@app/components/Button.vue';
import Loading from '@app/components/icons/Loading.vue';
import { cx } from '@app/utils';

const form = useForm({
  email: '',
});
</script>
<template>
  <Head title="Forgot Password" />
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
    <div class="mt-16 mb-8 w-fit mx-auto">
      <Logo />
    </div>
    <form
      @submit.prevent="form.post(route('forgot-password'))"
      class="mx-auto my-4 max-w-md bg-zinc-100 p-4 rounded-lg shadow-md"
    >
      <h1 class="text-2xl font-semibold text-center">Forgot your password?</h1>
      <p class="mb-4 text-center">Enter your email address and we'll send you a link to reset your password.</p>
      <Input v-model="form.email" :error="form.errors.email" label="Email Address" placeholder="jane@example.com" />
      <div class="mt-4 flex justify-end">
        <Button type="submit" :class="cx({ 'cursor-wait': form.processing })" :disabled="form.processing">
          <Loading class="size-5" v-if="form.processing" />
          <span v-else>Send Reset Link</span>
        </Button>
      </div>
    </form>
  </main>
</template>
