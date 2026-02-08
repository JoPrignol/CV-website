<template>
  <SquareShapeAnimation />
  <div class="flex flex-col gap-12 items-center justify-center mb-20 mx-4 lg:mx-0">
    <div
      v-for="passion in passions"
      :key="passion.id"
      class="lg:w-1/2 w-full border-2 border-foreground rounded-md lg:p-8 p-4 flex lg:flex-row flex-col items-start gap-6 bg-background"
    >
      <img v-if="passion.image_url" :src="passion.image_url" :alt="passion.name" class="lg:w-1/4 w-full aspect-auto h-auto rounded" />
      <div>
        <h2 class="text-3xl font-bold mb-2">
          {{ passion.name[locale] }}
        </h2>
        <p v-html="passion.description[locale]" class="mb-2 text-base lg:text-left text-justify"/>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Passion } from '@/types/passion';
import LanguageSwitcher from '@/components/custom/LanguageSwitcher.vue';
import SquareShapeAnimation from '@/components/custom/SquareShapeAnimation.vue';

const props = defineProps<{
  passions: Passion[];
  locale: string;
}>();

</script>
