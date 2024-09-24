<script setup lang="ts">
import { type HTMLAttributes, computed } from 'vue';
import {
  type CheckboxRootEmits,
  type CheckboxRootProps,
  CheckboxIndicator,
  CheckboxRoot,
  useForwardPropsEmits,
} from 'radix-vue';
import { clsx } from '@app/utils';
import Check from '@app/components/icons/Check.vue';

export type Props = CheckboxRootProps & {
  variant?: 'primary';
  class?: HTMLAttributes['class'];
};

export type Emits = CheckboxRootEmits;

const props = withDefaults(defineProps<Props>(), {
  variant: 'primary',
});
const emits = defineEmits<Emits>();

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props;

  return delegated;
});

const forwarded = useForwardPropsEmits(delegatedProps, emits);

const variants = {
  primary:
    'data-[state=checked]:bg-primary-600 dark:data-[state=checked]:bg-primary-600 focus-visible:ring-primary-600',
};
</script>

<template>
  <div data-slot="control">
    <CheckboxRoot
      v-bind="forwarded"
      v-bind:class="
        clsx(
          'peer size-6 shrink-0 rounded-md data-[disabled]:cursor-not-allowed data-[disabled]:opacity-50',
          'bg-transparent dark:bg-background-900',
          'border border-background-300 dark:border-background-700',
          'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2',
          variants[props.variant],
          props.class
        )
      "
    >
      <CheckboxIndicator class="flex items-center justify-center">
        <Check class="size-3.5 text-white" />
      </CheckboxIndicator>
      <span v-if="!forwarded.checked" class="flex items-center justify-center" data-state="unchecked">
        <span class="size-3.5" />
      </span>
    </CheckboxRoot>
  </div>
</template>
