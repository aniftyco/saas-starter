<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthLayout from '@app/layouts/auth.vue';
import { Button, Input, Field, Label, Checkbox, ErrorMessage, Fieldset } from '@app/components/ui';

defineOptions({
  layout: AuthLayout,
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      remember: form.remember ? 'on' : '',
    }))
    .post(route('sign-in'), {
      onFinish: () => form.reset('password'),
    });
};
</script>

<template>
  <Head title="Log in" />
  <form @submit.prevent="submit">
    <Fieldset class="gap-4 flex flex-col">
      <Field>
        <Label for="email">Email</Label>
        <Input
          name="email"
          autocomplete="email"
          placeholder="jane.doe@example.com"
          v-model="form.email"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.email"
        />
        <ErrorMessage v-if="form.errors.email">{{ form.errors.email }}</ErrorMessage>
      </Field>

      <Field>
        <Label for="password">Password</Label>
        <Input
          name="password"
          autocomplete="password"
          type="password"
          placeholder="hunter2"
          v-model="form.password"
          v-bind:invalid="form.errors.password"
        />
        <ErrorMessage v-if="form.errors.password">{{ form.errors.password }}</ErrorMessage>
      </Field>

      <Field class="flex items-center gap-3">
        <Checkbox v-model:checked="form.remember" name="remember" />
        <Label for="remember">Remember me</Label>
      </Field>
    </Fieldset>

    <div class="flex items-center justify-end mt-4 -mx-8 -mb-4 px-8 py-4 bg-background-50 dark:bg-background-900/30">
      <Link
        :href="route('password.forgot')"
        class="underline text-sm text-background-600 dark:text-background-400 hover:text-background-900 dark:hover:text-background-100 rounded-md focus:outline-none focus:ring-0"
      >
        Forgot your password?
      </Link>

      <Button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Log in</Button>
    </div>
  </form>
</template>
