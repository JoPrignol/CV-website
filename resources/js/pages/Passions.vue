<template>
  <div class="flex flex-col gap-12 items-center justify-center mb-20">
    <div
      v-for="passion in passions"
      :key="passion.id"
      class="w-1/2 border-2 border-white rounded-md p-8 flex items-start gap-6"
    >
      <img v-if="passion.image_url" :src="passion.image_url" :alt="passion.name" class="w-1/4 aspect-auto h-auto rounded" />
      <div>
        <h2 class="text-3xl font-bold mb-2">
          {{ passion.name[locale] }}
        </h2>
        <p v-html="passion.description[locale]" class="mb-2 text-base"/>
      </div>
    </div>
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
