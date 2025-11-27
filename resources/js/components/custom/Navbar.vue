<template>
  <div class="w-full flex items-center px-4 py-4" :class="isHomePage ? 'justify-end' : 'justify-between'">
    <a
      v-if="!isHomePage"
      class="text-2xl font-bold"
      :href="isProjectsPage && hasTagParam ? '/projects' : '/'"
    >
      <i class="fa-solid fa-arrow-left" style="color: #ffffff;" />
      {{isProjectsPage && hasTagParam ? localBackToProjects : localHome}}
    </a>
    <LanguageSwitcher />
  </div>
</template>

<script setup lang="ts">
import LanguageSwitcher from './LanguageSwitcher.vue';
import { usePage } from '@inertiajs/vue3';
import { useLocaleStore } from '@/stores/locale';
import { computed } from 'vue';

const localeStore = useLocaleStore();

const props = defineProps<{
  locale: string;
}>();

const page = usePage();

const isHomePage = computed(() => page.url === '/');
const isProjectsPage = computed(() => page.url.startsWith('/projects'));

const localHome = computed(() => {
  return localeStore.locale === 'fr' ? 'ACCUEIL' : 'HOME';
});

const urlParams = computed(() => {
  const queryString = page.url.split('?')[1] || '';
  return new URLSearchParams(queryString);
});

const hasTagParam = computed(() => {
  return urlParams.value.has('tag');
});

const localBackToProjects = computed(() => {
  switch (localeStore.locale) {
    case 'fr':
      return 'TOUS LES PROJETS';
    case 'de':
      return 'ALLE PROJEKTE';
    case 'en':
    default:
      return 'ALL PROJECTS';
  }
});

</script>
