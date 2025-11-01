<template>
  <div class="flex items-center gap-2">
    <button
      v-for="l in locales"
      :key="l"
      @click="switchLanguage(l)"
      :class="[
        'px-3 py-1 font-bold',
        currentLocale === l ? 'bg-gray-500 text-white' : 'bg-gray-200 text-gray-800'
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
