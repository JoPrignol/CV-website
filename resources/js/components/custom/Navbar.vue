<template>
  <div class="w-full flex items-center px-4 py-4" :class="isHomePage ? 'justify-end' : 'justify-between'">
    <a
      v-if="!isHomePage"
      class="text-2xl font-bold reverse-text-moving-rainbow text-foreground"
      :href="isProjectsPage && hasTagParam ? '/projects' : '/'"
    >
      <i class="fa-solid fa-arrow-left" />
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

const isMobile = window.matchMedia("(max-width: 768px)").matches;


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
      if (isMobile){
        return 'PROJETS';
      } else {
        return 'TOUS LES PROJETS';
      }
    case 'de':
      if (isMobile){
        return 'PROJEKTE';
      } else {
        return 'ALLE PROJEKTE';
      }
    case 'en':
      if (isMobile){
        return 'PROJECTS';
      } else {
        return 'ALL PROJECTS';
      }
    default:
      return 'PROJECTS';
  }
});

</script>

<style scoped>
  .reverse-text-moving-rainbow {
    /* color: white; */
    background: linear-gradient(90deg, #00C0FF 0%, #FFCF00 49%, #FC4F4F 80%, #00C0FF 100%);
    background-clip: text;
    -webkit-background-clip: text;
  }

  .reverse-text-moving-rainbow:hover {
    color: transparent;
    transition: 500ms ease;
    animation:reverseSlidebg 10s linear infinite;
  }

  @keyframes reverseSlidebg {
  to {
    background-position:-20vw;
  }
}
</style>
