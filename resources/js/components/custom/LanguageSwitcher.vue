<template>
  <div class="flex items-center gap-2">
    <button
      v-for="l in locales"
      :key="l"
      @click="switchLanguage(l)"
      :class="[
        'px-3 py-1 font-bold border-1 rounded-md border-white',
        currentLocale === l ? 'bg-white text-black' : 'bg-none text-white hover:border-black duration-150 ease-in-out'
      ]"
    >
      {{ l.toUpperCase() }}
    </button>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const locales = ['fr', 'en', 'de']
const currentLocale = ref(document.documentElement.lang || 'fr')

const switchLanguage = async (locale: any) => {
  await fetch(`/lang/${locale}`);
  window.dispatchEvent(new CustomEvent('locale-changed', { detail: { locale } }));
  window.location.reload();
}
</script>
