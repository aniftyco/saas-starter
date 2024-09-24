<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { PageHeader, SectionBorder } from '@app/components/ui';
import {
  DeleteAccountForm,
  BrowserSessionsForm,
  type BrowserSessionsFormProps,
  UpdateAccountInformationForm,
  UpdatePasswordForm,
} from '@app/forms';

type PageProps = {
  auth: {
    user: {
      name: string;
      email: string;
    };
  };
};

export type Props = {
  sessions: BrowserSessionsFormProps['sessions'];
};

const page = usePage<PageProps>();
const props = defineProps<Props>();
</script>

<template>
  <Head title="Account" />
  <PageHeader>Account</PageHeader>
  <main>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <UpdateAccountInformationForm :user="page.props.auth.user" />

      <SectionBorder />

      <UpdatePasswordForm class="mt-10 sm:mt-0" />

      <SectionBorder />

      <!-- <TwoFactorAuthenticationForm :requires-confirmation="false" class="mt-10 sm:mt-0" /> -->

      <!-- <SectionBorder /> -->

      <BrowserSessionsForm :sessions="props.sessions" class="mt-10 sm:mt-0" />

      <SectionBorder />

      <DeleteAccountForm class="mt-10 sm:mt-0" />
    </div>
  </main>
</template>
