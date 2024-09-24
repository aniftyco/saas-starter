<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ActionMessage, Button, FormSection, Field, Label, Input, ErrorMessage } from '@app/components/ui';

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.put(route('password.change'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation');
      }

      if (form.errors.current_password) {
        form.reset('current_password');
      }
    },
  });
};
</script>

<template>
  <FormSection @submitted="submit">
    <template #title>Update Password</template>

    <template #description>Ensure your account is using a long, random password to stay secure.</template>

    <template #form>
      <!-- Current Password -->
      <Field class="col-span-6 sm:col-span-4">
        <Label for="current_password">Current Password</Label>
        <Input
          name="current_password"
          autocomplete="current_password"
          type="password"
          v-model="form.current_password"
          v-bind:invalid="form.errors.current_password"
        />
        <ErrorMessage v-if="form.errors.current_password">{{ form.errors.current_password }}</ErrorMessage>
      </Field>

      <!-- New Password -->
      <Field class="col-span-6 sm:col-span-4">
        <Label for="password">New Password</Label>
        <Input
          name="password"
          autocomplete="password"
          type="password"
          v-model="form.password"
          v-bind:invalid="form.errors.password"
        />
        <ErrorMessage v-if="form.errors.password">{{ form.errors.password }}</ErrorMessage>
      </Field>

      <!-- Password Confirmation -->
      <Field class="col-span-6 sm:col-span-4">
        <Label for="password_confirmation">Password Confirmation</Label>
        <Input
          name="password_confirmation"
          autocomplete="new-password"
          type="password"
          v-model="form.password_confirmation"
          v-bind:invalid="form.errors.password_confirmation"
        />
        <ErrorMessage v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</ErrorMessage>
      </Field>
    </template>

    <template #actions>
      <ActionMessage :on="form.recentlySuccessful" class="me-3">Saved.</ActionMessage>

      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</Button>
    </template>
  </FormSection>
</template>
