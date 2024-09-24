<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AuthLayout from '@app/layouts/auth.vue';
import { Button, Fieldset, Field, Label, Input, ErrorMessage } from '@app/components/ui';

defineOptions({
  layout: AuthLayout,
});

export type Props = {
  email: string;
  token: string;
};

const props = defineProps<Props>();

const form = useForm({
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.update', { reset: props.token }), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <Head title="Reset Password" />

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
        <Label for="email">Confirm Password</Label>
        <Input
          name="password_confirmation"
          autocomplete="confirm-password"
          type="password"
          placeholder="hunter2"
          v-model="form.password_confirmation"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.password_confirmation"
        />
        <ErrorMessage v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</ErrorMessage>
      </Field>
    </Fieldset>

    <div class="flex items-center justify-end mt-4 -mx-8 -mb-4 px-8 py-4 bg-background-50 dark:bg-background-900/30">
      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Reset Password </Button>
    </div>
  </form>
</template>
