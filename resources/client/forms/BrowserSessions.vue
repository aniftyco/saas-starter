<script setup lang="ts">
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { ActionMessage, ActionSection, Button, DialogModal, Field, Input, ErrorMessage } from '@app/components/ui';

export type Session = {
  id: string;
  ipAddress: string;
  browser?: string;
  platform?: string;
  isDesktop: boolean;
  location?: {
    city: string;
    region: string;
    country: string;
  };
  isCurrentDevice: boolean;
  lastActiveAt: string;
};

export type Props = {
  sessions: Session[];
};

const props = defineProps<Props>();

const confirming = ref(false);
const input = ref(null);

const form = useForm({
  password: '',
});

const confirm = () => {
  confirming.value = true;

  setTimeout(() => input.value.focus(), 250);
};

const signOut = () => {
  form.delete(route('sessions.destroy'), {
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
    <template #title>Browser Sessions</template>

    <template #description>Manage and sign out your active sessions on other browsers and devices.</template>

    <template #content>
      <div class="max-w-xl text-sm text-background-600 dark:text-background-400">
        If necessary, you may sign out of all of your other browser sessions across all of your devices. Some of your
        recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been
        compromised, you should also update your password.
      </div>

      <!-- Other Browser Sessions -->
      <div v-if="props.sessions.length > 0" class="mt-5 space-y-6">
        <div
          v-for="(session, i) in props.sessions.sort((a, b) =>
            a.isCurrentDevice === b.isCurrentDevice ? 0 : a.isCurrentDevice ? -1 : 1
          )"
          :key="i"
          class="flex items-center"
        >
          <div>
            <svg
              v-if="session.isDesktop"
              class="w-8 h-8 text-background-500"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"
              />
            </svg>

            <svg
              v-else
              class="w-8 h-8 text-background-500"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"
              />
            </svg>
          </div>

          <div class="ms-3">
            <div class="text-sm text-background-600 dark:text-background-400">
              <span
                >{{ session.platform ? session.platform : 'Unknown' }} -
                {{ session.browser ? session.browser : 'Unknown' }}
              </span>
              <span v-if="session.isCurrentDevice" class="text-green-500 text-xs ms-1">This device</span>
              <span v-else class="text-background-700 dark:text-background-500 text-xs ms-1"
                >Last active {{ session.lastActiveAt }}</span
              >
            </div>

            <div>
              <div class="text-xs text-background-500">
                <span :title="session.ipAddress">{{
                  session.location
                    ? `${session.location.city}, ${session.location.region}, ${session.location.country}`
                    : session.ipAddress
                }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #actions>
      <ActionMessage :on="form.recentlySuccessful" class="me-3">Done.</ActionMessage>
      <Button @click="confirm">Sign Out Other Browser Sessions</Button>
      <!-- Sign Out Other Devices Confirmation Modal -->
      <DialogModal :show="confirming" @close="close">
        <template #title> Sign Out Other Browser Sessions </template>

        <template #content>
          Please enter your password to confirm you would like to sign out of your other browser sessions across all of
          your devices.

          <Field class="mt-4">
            <Input
              ref="input"
              v-model="form.password"
              type="password"
              class="mt-1 block w-3/4"
              placeholder="Password"
              autocomplete="current-password"
              @keyup.enter="signOut"
            />

            <ErrorMessage v-if="form.errors.password" class="mt-2">{{ form.errors.password }}</ErrorMessage>
          </Field>
        </template>

        <template #footer>
          <Button variant="secondary" @click="close">Cancel</Button>

          <Button class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="signOut">
            sign out Other Browser Sessions
          </Button>
        </template>
      </DialogModal>
    </template>
  </ActionSection>
</template>
