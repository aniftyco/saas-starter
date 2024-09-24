<script setup lang="ts">
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthLayout from '@app/layouts/auth.vue';
import { Button, Fieldset, Field, Input, ErrorMessage } from '@app/components/ui';

defineOptions({
  layout: AuthLayout,
});

const form = useForm({
  password: '',
});

const input = ref(null);

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => {
      form.reset();

      input.value.focus();
    },
  });
};
</script>

<template>
  <Head title="Reset Password" />

  <form @submit.prevent="submit">
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <Fieldset class="gap-4 flex flex-col">
      <Field>
        <Input
          name="password"
          autocomplete="password"
          type="password"
          placeholder="hunter2"
          ref="input"
          v-model="form.password"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.password"
        />
        <ErrorMessage v-if="form.errors.password">{{ form.errors.password }}</ErrorMessage>
      </Field>
    </Fieldset>

    <div class="flex items-center justify-end mt-4 -mx-8 -mb-4 px-8 py-4 bg-background-50 dark:bg-background-900/30">
      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Confirm Password</Button>
    </div>
  </form>
</template>
