<template>
  <div class="flex items-center gap-2">
    <button
      v-for="l in locales"
      :key="l"
      @click="switchLanguage(l)"
      :class="[
        'px-3 py-1 text-lg font-bold border-2 rounded-md border-transparent',
        currentLocale === l ? 'bg-foreground text-background' : 'bg-none text-foreground hover:border-foreground duration-150 ease-in-out'
      ]"
    >
      {{ l.toUpperCase() }}
    </button>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useLocaleStore } from '@/stores/locale';

const localeStore = useLocaleStore();

const locales = ['fr', 'en', 'de']

const currentLocale = ref(document.documentElement.lang || 'fr')

const switchLanguage = async (locale: any) => {
  await fetch(`/lang/${locale}`);
  localeStore.setLocale(locale)
  document.cookie = `locale=${locale};path=/;SameSite=Lax`;
  window.dispatchEvent(new CustomEvent('locale-changed', { detail: { locale } }));
  window.location.reload();
}
</script>
