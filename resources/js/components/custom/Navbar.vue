<template>
  <div class="w-full flex items-center px-4 py-4" :class="isHomePage ? 'justify-end' : 'justify-between'">
    <a
      v-if="!isHomePage"
      class="text-xl font-bold"
      href="/"
    >
      <i class="fa-solid fa-arrow-left" style="color: #ffffff;" />
      {{localHome}}
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

const localHome = computed(() => {
  return localeStore.locale === 'fr' ? 'ACCUEIL' : 'HOME';
});

</script>
