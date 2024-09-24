<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthLayout from '@app/layouts/auth.vue';
import { Button, Input, Field, Label, Checkbox, ErrorMessage, Fieldset } from '@app/components/ui';

defineOptions({
  layout: AuthLayout,
});

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
});

const submit = () => {
  form.post(route('sign-up'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <Head title="Sign Up" />

  <form @submit.prevent="submit">
    <Fieldset class="gap-4 flex flex-col">
      <Field>
        <Label for="name">Name</Label>
        <Input
          name="name"
          autocomplete="name"
          placeholder="Jane Doe"
          v-model="form.name"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.name"
        />
        <ErrorMessage v-if="form.errors.name">{{ form.errors.name }}</ErrorMessage>
      </Field>

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

      <Field>
        <Label for="password">Password</Label>
        <Input
          name="password"
          autocomplete="password"
          type="password"
          placeholder="hunter2"
          v-model="form.password"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.password"
        />
        <ErrorMessage v-if="form.errors.password">{{ form.errors.password }}</ErrorMessage>
      </Field>

      <Field>
        <Label for="password_confirmation">Confirm Password</Label>
        <Input
          name="password_confirmation"
          autocomplete="password-confirmation"
          type="password"
          placeholder="hunter2"
          v-model="form.password_confirmation"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.password_confirmation"
        />
        <ErrorMessage v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</ErrorMessage>
      </Field>

      <Field class="flex flex-col">
        <div class="flex items-center gap-3">
          <Checkbox v-model:checked="form.term" name="term" />
          <Label for="term" class="text-sm">
            I agree to the
            <a
              target="_blank"
              :href="route('home')"
              class="underline text-background-600 dark:text-background-400 hover:text-background-900 dark:hover:text-background-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-background-800"
              >Terms of Service</a
            >
            and
            <a
              target="_blank"
              :href="route('home')"
              class="underline text-background-600 dark:text-background-400 hover:text-background-900 dark:hover:text-background-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-background-800"
              >Privacy Policy</a
            >
          </Label>
        </div>
        <ErrorMessage v-if="form.errors.terms" class="mt-2">{{ form.errors.terms }}</ErrorMessage>
      </Field>
    </Fieldset>

    <div class="flex items-center justify-end mt-4 -mx-8 -mb-4 px-8 py-4 bg-background-50 dark:bg-background-900/30">
      <Link
        :href="route('sign-in')"
        class="underline text-sm text-background-600 dark:text-background-400 hover:text-background-900 dark:hover:text-background-100 rounded-md focus:outline-none focus:ring-0"
      >
        Already registered?
      </Link>

      <Button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Register </Button>
    </div>
  </form>
</template>
