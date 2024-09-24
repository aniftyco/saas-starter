<script setup lang="ts">
import { Modal } from '@app/components/ui';

export type Props = {
  show?: boolean;
  maxWidth?: string;
  closeable?: boolean;
};

export type Emits = {
  close: [];
};

const emit = defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
  show: false,
  maxWidth: '2xl',
  closeable: true,
});

const close = () => {
  emit('close');
};
</script>

<template>
  <Modal :show="props.show" :max-width="props.maxWidth" :closeable="props.closeable" @close="close">
    <div class="px-6 py-4">
      <div class="text-lg font-medium text-background-900 dark:text-background-100">
        <slot name="title" />
      </div>

      <div class="mt-4 text-sm text-background-600 dark:text-background-400">
        <slot name="content" />
      </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-background-100 dark:bg-background-800">
      <slot name="footer" />
    </div>
  </Modal>
</template>
