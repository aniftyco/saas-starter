<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ActionMessage, Button, FormSection, Field, Label, Input, ErrorMessage } from '@app/components/ui';

export type Props = {
  user: {
    name: string;
    email: string;
  };
};

const props = defineProps<Props>();

const form = useForm(props.user);

const submit = () => {
  form.put(route('account.update'), {
    errorBag: 'submit',
    preserveScroll: true,
  });
};
</script>

<template>
  <FormSection @submitted="submit">
    <template #title>Account Information</template>

    <template #description>Update your account information and email address.</template>

    <template #form>
      <!-- Name -->
      <Field class="col-span-6 sm:col-span-4">
        <Label for="name">Name</Label>
        <Input
          name="name"
          autocomplete="name"
          type="text"
          v-model="form.name"
          v-bind:autofocus="true"
          v-bind:invalid="form.errors.name"
        />
        <ErrorMessage v-if="form.errors.name">{{ form.errors.name }}</ErrorMessage>
      </Field>

      <!-- Email -->
      <Field class="col-span-6 sm:col-span-4">
        <Label for="email">Email</Label>
        <Input name="email" autocomplete="email" type="email" v-model="form.email" v-bind:invalid="form.errors.email" />
        <ErrorMessage v-if="form.errors.email">{{ form.errors.email }}</ErrorMessage>
      </Field>
    </template>

    <template #actions>
      <ActionMessage :on="form.recentlySuccessful" class="me-3">Saved.</ActionMessage>

      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</Button>
    </template>
  </FormSection>
</template>
