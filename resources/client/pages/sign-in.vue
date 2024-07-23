<script setup lang="ts">
import { useForm, Head, Link } from '@inertiajs/vue3';
import Logo from '@app/components/Logo.vue';
import Input from '@app/components/Input.vue';
import Checkbox from '@app/components/Checkbox.vue';
import Button from '@app/components/Button.vue';
import Loading from '@app/components/icons/Loading.vue';
import { cx } from '@app/utils';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});
</script>
<template>
  <Head title="Sign In" />
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
    <div class="mt-16 mb-8 w-fit mx-auto">
      <Logo />
    </div>
    <form
      @submit.prevent="form.post(route('sign-in'))"
      class="mx-auto my-4 max-w-md bg-zinc-100 p-4 rounded-lg shadow-md"
    >
      <h1 class="text-2xl font-semibold text-center">Welcome back</h1>
      <p class="mb-4 text-center">Please enter your credentials to sign in.</p>
      <Input v-model="form.email" :error="form.errors.email" label="Email Address" placeholder="jane@example.com" />
      <Input
        v-model="form.password"
        :error="form.errors.password"
        label="Password"
        type="password"
        placeholder="hunter2"
      />
      <div class="mt-4">
        <Checkbox v-model="form.remember" label="Remember me" />
      </div>
      <div class="mt-4 flex items-center justify-end space-x-2">
        <Link href="/forgot-password" class="text-sm font-medium hover:underline">Forgot your password?</Link>
        <Button type="submit" :class="cx({ 'cursor-wait': form.processing })" :disabled="form.processing">
          <Loading class="size-5" v-if="form.processing" />
          <span v-else>Sign in</span>
        </Button>
      </div>
    </form>
  </main>
</template>
