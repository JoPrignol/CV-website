<template>
  <LanguageSwitcher />
  <div>Passions Page</div>
  <div v-for="passion in passions" :key="passion.id" class="mb-6">
    <h2 class="text-xl font-bold mb-2">{{ passion.name[locale] }}</h2>
    <p v-html="passion.description[locale]" class="mb-2"/>
    <img v-if="passion.image" :src="passion.image" :alt="passion.name" class="w-full h-auto rounded" />
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Passion } from '@/types/passion';
import LanguageSwitcher from '@/components/custom/LanguageSwitcher.vue';

const props = defineProps<{
  passions: Passion[];
  locale: string;
}>();

</script>
