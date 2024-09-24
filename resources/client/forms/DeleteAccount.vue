<script setup lang="ts">
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { ActionSection, Button, DialogModal, ErrorMessage, Field, Input } from '@app/components/ui';

const confirming = ref(false);
const input = ref(null);

const form = useForm({
  password: '',
});

const confirm = () => {
  confirming.value = true;

  setTimeout(() => input.value.focus(), 250);
};

const submit = () => {
  form.delete(route('account.destroy'), {
    preserveScroll: true,
    onSuccess: () => close(),
    onError: () => input.value.focus(),
    onFinish: () => form.reset(),
  });
};

const close = () => {
  confirming.value = false;

  form.reset();
};
</script>

<template>
  <ActionSection>
    <template #title>Delete Account</template>
    <template #description>Permanently delete your account.</template>
    <template #content>
      <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your
        account, please download any data or information that you wish to retain.
      </div>
    </template>
    <template #actions>
      <Button variant="danger" @click="confirm">Delete Account</Button>

      <!-- Delete Account Confirmation Modal -->
      <DialogModal :show="confirming" @close="close">
        <template #title>Delete Account</template>

        <template #content>
          Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will
          be permanently deleted. Please enter your password to confirm you would like to permanently delete your
          account.

          <Field class="mt-4">
            <Input
              v-model="form.password"
              type="password"
              class="mt-1 block w-3/4"
              placeholder="Password"
              autocomplete="current-password"
              ref="input"
              v-on:keyup.enter="submit"
              v-bind:invalid="form.errors.password"
            />
            <ErrorMessage v-if="form.errors.password" class="mt-2">{{ form.errors.password }}</ErrorMessage>
          </Field>
        </template>

        <template #footer>
          <Button variant="secondary" @click="close">Cancel</Button>

          <Button
            variant="danger"
            class="ms-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="submit"
          >
            Confirm Delete
          </Button>
        </template>
      </DialogModal>
    </template>
  </ActionSection>
</template>
