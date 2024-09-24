<script setup lang="ts">
import { ref, reactive, nextTick } from 'vue';
import { Button, DialogModal, ErrorMessage, Field, Input } from '@app/components/ui';

export type Props = {
  title?: string;
  subtitle?: string;
  action?: string;
};

export type Emits = {
  confirmed: [];
};

const emit = defineEmits<Emits>();
withDefaults(defineProps<Props>(), {
  title: 'Confirm Password',
  subtitle: 'For your security, please confirm your password to continue.',
  action: 'Confirm',
});

const confirming = ref(false);

const form = reactive({
  password: '',
  error: '',
  processing: false,
});

const passwordInput = ref(null);

const checkStatus = () => {
  axios.get(route('password.confirm.status')).then((response) => {
    if (response.data.confirmed) {
      emit('confirmed');
    } else {
      confirming.value = true;

      setTimeout(() => passwordInput.value.focus(), 250);
    }
  });
};

const submit = () => {
  form.processing = true;

  axios
    .post(route('password.confirm'), {
      password: form.password,
    })
    .then(() => {
      form.processing = false;

      close();
      nextTick().then(() => emit('confirmed'));
    })
    .catch((error) => {
      form.processing = false;
      form.error = error.response.data.errors.password[0];
      passwordInput.value.focus();
    });
};

const close = () => {
  confirming.value = false;
  form.password = '';
  form.error = '';
};
</script>

<template>
  <span>
    <span @click="checkStatus">
      <slot />
    </span>

    <DialogModal :show="confirming" @close="close">
      <template #title>
        {{ title }}
      </template>

      <template #content>
        {{ subtitle }}

        <Field class="mt-4">
          <Input
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="Password"
            autocomplete="current-password"
            @keyup.enter="submit"
          />

          <ErrorMessage v-if="form.error" class="mt-2">{{ form.error }}</ErrorMessage>
        </Field>
      </template>

      <template #footer>
        <Button variant="secondary" @click="close">Cancel</Button>

        <Button class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="submit">
          {{ action }}
        </Button>
      </template>
    </DialogModal>
  </span>
</template>
