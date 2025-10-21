<template>
  <LanguageSwitcher />
  <div>Passions Page</div>
  <div v-for="passion in passions" :key="passion.id" class="mb-6">
    <h2 class="text-xl font-bold mb-2">{{ passion.name[currentLocale] }}</h2>
    <p v-html="passion.description[currentLocale]" class="mb-2"/>
    <img v-if="passion.image" :src="passion.image" :alt="passion.name" class="w-full h-auto rounded" />
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Passion } from '@/types/passion';
import LanguageSwitcher from '@/components/custom/LanguageSwitcher.vue';
import { ref } from 'vue';

function getLocale(): string {
  const match = document.cookie.match(/locale=(\w+)/)
  return match ? match[1] : 'fr'
}

// TODO: Problèmes: lors du changement de langue, les textes ne changent pas.
// + Créer un composable pour éviter de dupliquer le code dans chaque page

const currentLocale = ref(getLocale())

const props = defineProps<{
  passions: Passion[];
}>();
</script>
