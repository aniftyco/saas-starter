<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AuthLayout from '@app/layouts/auth.vue';
import { Button, Fieldset, Field, Label, Input, ErrorMessage } from '@app/components/ui';

defineOptions({
  layout: AuthLayout,
});

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('password.email'));
};
</script>

<template>
  <Head title="Forgot Password" />

  <div class="mb-4 text-sm text-background-600 dark:text-background-400">
    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link
    that will allow you to choose a new one.
  </div>

  <form @submit.prevent="submit">
    <Fieldset class="gap-4 flex flex-col">
      <Field>
        <Label for="email">Email</Label>
        <Input
          name="email"
          autocomplete="email"
          type="email"
          placeholder="jane.doe@example.com"
          v-model="form.email"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.email"
        />
        <ErrorMessage v-if="form.errors.email">{{ form.errors.email }}</ErrorMessage>
      </Field>
    </Fieldset>

    <div class="flex items-center justify-end mt-4 -mx-8 -mb-4 px-8 py-4 bg-background-50 dark:bg-background-900/30">
      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Email Password Reset Link
      </Button>
    </div>
  </form>
</template>
