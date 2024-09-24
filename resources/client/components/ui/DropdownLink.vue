<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { clsx } from '@app/utils';

export type Props = {
  href?: string;
  as?: 'a' | 'button';
};

const props = defineProps<Props>();
</script>

<template>
  <div>
    <button
      v-if="props.as == 'button'"
      type="submit"
      v-bind:class="
        clsx(
          'block w-full px-4 py-2 text-start text-sm leading-5 text-background-700 dark:text-background-300 hover:bg-background-100 dark:hover:bg-background-800 focus:outline-none focus:bg-background-100 dark:focus:bg-background-800 transition duration-150 ease-in-out',
          $attrs.class
        )
      "
    >
      <slot />
    </button>

    <a
      v-else-if="props.as == 'a'"
      v-bind:href="props.href"
      v-bind:class="
        clsx(
          'block px-4 py-2 text-sm leading-5 text-background-700 dark:text-background-300 hover:bg-background-100 dark:hover:bg-background-800 focus:outline-none focus:bg-background-100 dark:focus:bg-background-800 transition duration-150 ease-in-out',
          $attrs.class
        )
      "
    >
      <slot />
    </a>

    <Link
      v-else
      v-bind:href="props.href"
      v-bind:class="
        clsx(
          'block px-4 py-2 text-sm leading-5 text-background-700 dark:text-background-300 hover:bg-background-100 dark:hover:bg-background-800 focus:outline-none focus:bg-background-100 dark:focus:bg-background-800 transition duration-150 ease-in-out',
          $attrs.class
        )
      "
    >
      <slot />
    </Link>
  </div>
</template>
