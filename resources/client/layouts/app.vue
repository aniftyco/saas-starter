<script setup lang="ts">
import { ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Logo from '@app/components/Logo.vue';
import { Dropdown, DropdownLink, NavLink, ResponsiveNavLink } from '@app/components/ui';

type PageProps = {
  auth: {
    user: {
      name: string;
      email: string;
    };
  };
};

const { props } = usePage<PageProps>();
const showingNavigationDropdown = ref(false);

const gravatar = 'https://gravatar.com/userimage/19287721/9cd577bdd3c1f36f600a246863a5f7bb.jpeg?size=256';

type Team = {
  id: number;
  name: string;
  gravatar: string;
};

const teams = ref<Team[]>([
  {
    id: 1,
    name: 'NiftyCo',
    gravatar: 'https://gravatar.com/userimage/19287721/3b23639d7301ff9750239d102fe89d1e.jpeg?size=256',
  },
  {
    id: 2,
    name: 'Makerlog',
    gravatar: 'https://gravatar.com/userimage/19287721/68967519d9da108bfc7e567d9b50e5ce.jpeg?size=256',
  },
]);

const selectedTeam = ref(teams.value[0]);

const switchToTeam = (team: Team) => {
  selectedTeam.value = team;
};

const signOut = () => {
  router.post(route('sign-out'));
};
</script>

<template>
  <div class="min-h-screen bg-background-100 dark:bg-background-900">
    <nav class="bg-white dark:bg-background-800 border-b border-background-100 dark:border-background-700">
      <!-- Primary Navigation Menu -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <!-- Logo -->
            <Link :href="route('home')" class="me-4">
              <Logo size="md" />
            </Link>

            <!-- Divider -->
            <div aria-hidden="true" class="hidden sm:block h-6 w-px bg-background-950/10 dark:bg-white/10" />

            <!-- Teams Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-4 sm:me-4">
              <Dropdown align="right">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button
                      class="inline-flex items-center px-2 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-background-500 dark:text-background-400 bg-white dark:bg-background-800 hover:text-background-700 dark:hover:text-background-300 focus:outline-none focus:bg-background-100 dark:focus:bg-background-700 hover:bg-background-100 dark:hover:bg-background-700 active:bg-background-100 dark:active:bg-background-700 transition ease-in-out duration-150"
                      type="button"
                    >
                      <img
                        class="size-5 rounded-full object-cover"
                        :src="selectedTeam.gravatar"
                        :alt="selectedTeam.name"
                      />
                      <span class="ms-2 -me-0.5">{{ selectedTeam.name }}</span>

                      <svg
                        class="ms-2 -me-0.5 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                        />
                      </svg>
                    </button>
                  </span>
                </template>

                <template #content>
                  <!-- Team Settings -->
                  <DropdownLink :href="route('home')">Team Settings</DropdownLink>
                  <!-- Team Switcher -->

                  <div class="border-t border-background-200 dark:border-background-600" />

                  <template v-for="team in teams" :key="team.id">
                    <form @submit.prevent="switchToTeam(team)">
                      <DropdownLink
                        as="button"
                        class="flex items-center justify-between"
                        v-bind:class="team.id === selectedTeam.id && 'bg-background-200 dark:bg-background-800/70'"
                      >
                        <div class="flex items-center gap-3">
                          <img class="size-5 rounded-full object-cover" :src="team.gravatar" :alt="team.name" />
                          <span>{{ team.name }}</span>
                        </div>
                        <svg
                          v-if="team.id == selectedTeam.id"
                          class="size-5 text-green-500 dark:text-green-400"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                          />
                        </svg>
                      </DropdownLink>
                    </form>
                  </template>

                  <div class="border-t border-background-200 dark:border-background-600" />
                  <DropdownLink :href="route('home')">Create New Team</DropdownLink>
                </template>
              </Dropdown>
            </div>

            <!-- Divider -->
            <div aria-hidden="true" class="hidden sm:block h-6 w-px bg-background-950/10 dark:bg-white/10" />

            <!-- Navigation Links -->
            <div class="hidden space-x-3 sm:-my-px sm:flex ms-4">
              <NavLink :href="route('home')" :active="route.is('home')">Dashboard</NavLink>
              <NavLink :href="route('account')" :active="route.is('account')">Account</NavLink>
            </div>
          </div>

          <div class="hidden sm:flex sm:items-center sm:ms-6">
            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
              <Dropdown align="right">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button
                      type="button"
                      class="inline-flex items-center px-2 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-background-500 dark:text-background-400 bg-white dark:bg-background-800 hover:text-background-700 dark:hover:text-background-300 focus:outline-none focus:bg-background-100 dark:focus:bg-background-700 hover:bg-background-100 dark:hover:bg-background-700 active:bg-background-100 dark:active:bg-background-700 transition ease-in-out duration-150"
                    >
                      <img class="size-5 rounded-full object-cover" :src="gravatar" :alt="props.auth.user.name" />

                      <span class="ms-2 -me-0.5">{{ props.auth.user.name }}</span>

                      <svg
                        class="ms-2 -me-0.5 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                      >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                      </svg>
                    </button>
                  </span>
                </template>

                <template #content>
                  <!-- Account Management -->
                  <div class="block px-4 py-2 text-xs text-background-400">Manage Account</div>

                  <DropdownLink :href="route('account')">Account</DropdownLink>

                  <DropdownLink :href="route('home')">API Tokens</DropdownLink>

                  <div class="border-t border-background-200 dark:border-background-600" />

                  <!-- Authentication -->
                  <form @submit.prevent="signOut">
                    <DropdownLink as="button">Sign Out</DropdownLink>
                  </form>
                </template>
              </Dropdown>
            </div>
          </div>

          <!-- Hamburger -->
          <div class="-me-2 flex items-center sm:hidden">
            <button
              class="inline-flex items-center justify-center p-2 rounded-md text-background-400 dark:text-background-500 hover:text-background-500 dark:hover:text-background-400 hover:bg-background-100 dark:hover:bg-background-900 focus:outline-none focus:bg-background-100 dark:focus:bg-background-900 focus:text-background-500 dark:focus:text-background-400 transition duration-150 ease-in-out"
              @click="showingNavigationDropdown = !showingNavigationDropdown"
            >
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path
                  :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
          <ResponsiveNavLink :href="route('home')" :active="route.is('home')">Dashboard</ResponsiveNavLink>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-background-200 dark:border-background-600">
          <div class="flex items-center px-4">
            <div class="shrink-0 me-3">
              <img class="h-10 w-10 rounded-full object-cover" :src="gravatar" :alt="props.auth.user.name" />
            </div>

            <div>
              <div class="font-medium text-base text-background-800 dark:text-background-200">
                {{ props.auth.user.name }}
              </div>
              <div class="font-medium text-sm text-background-500">
                {{ props.auth.user.email }}
              </div>
            </div>
          </div>

          <div class="mt-3 space-y-1">
            <ResponsiveNavLink :href="route('account')" :active="route.is('account')">Account</ResponsiveNavLink>
            <ResponsiveNavLink :href="route('banner')" :active="route.is('banner')">API Tokens</ResponsiveNavLink>

            <!-- Authentication -->
            <form @submit.prevent="signOut">
              <ResponsiveNavLink as="button">Sign Out</ResponsiveNavLink>
            </form>

            <!-- Team Management -->

            <div class="border-t border-background-200 dark:border-background-600" />

            <div class="block px-4 py-2 text-xs text-background-400">Manage Team</div>

            <!-- Team Settings -->
            <ResponsiveNavLink :href="route('banner')" :active="route.is('banner')">Team Settings</ResponsiveNavLink>
            <ResponsiveNavLink :href="route('banner')" :active="route.is('banner')">Create New Team</ResponsiveNavLink>

            <!-- Team Switcher -->
            <div class="border-t border-background-200 dark:border-background-600" />
            <div class="block px-4 py-2 text-xs text-background-400">Switch Teams</div>
            <template v-for="team in teams" :key="team.id">
              <form @submit.prevent="switchToTeam(team)">
                <ResponsiveNavLink as="button">
                  <div class="flex items-center">
                    <svg
                      v-if="team.id == 1"
                      class="me-2 h-5 w-5 text-green-400"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <span>{{ team.name }}</span>
                  </div>
                </ResponsiveNavLink>
              </form>
            </template>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <slot />
  </div>
</template>
