<template>
  <div class="flex flex-col gap-12 items-center justify-center mb-20">
    <div
      v-for="exp in experiences" :key="exp.id"
      class="w-1/2 border-2 border-foreground rounded-md p-8 bg-background"
    >
      <div class="flex flex-row gap-4">
        <a
          v-if="exp.company.website_url"
          :href="exp.company.website_url"
          target="_blank"
          rel="noopener noreferrer"
        >
          <img
            v-if="exp.company.logo_url"
            :src="exp.company.logo_url"
            :alt="exp.company.name"
            class="w-[50px] aspect-square"
          />
        </a>
        <img
          v-else
          :src="exp.company.logo_url"
          :alt="exp.company.name"
          class="w-[50px] aspect-square"
        />
        <div>
          <h2 class="text-3xl font-bold">
            <span v-if="exp.position">
              {{ exp.position[locale] }}
            </span>
            <span> - </span>
            <span v-if="exp.company">
              {{ exp.company.name[locale] }}
            </span>
          </h2>
          <p class="text-xl">
            <span v-if="exp.end_date">{{ formatDate(exp.start_date) }} - {{ formatDate(exp.end_date) }}</span>
            <span v-else>{{fromWordByLocale[locale]}} {{ formatDate(exp.start_date) }}</span>
          </p>
          <p
            v-if="exp.location"
            class="text-base"
          >
            {{atWordByLocale[locale]}} {{ exp.location[locale] }}
          </p>
        </div>
      </div>

      <p
        v-html="exp.description[locale]"
        class="mt-4 text-justify text-base"
      />

    </div>
  </div>

</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Experience } from '@/types/experience';
import dayjs from 'dayjs';


const props = defineProps<{
  experiences: Experience[];
  locale: 'fr' | 'en' | 'de';
}>();

  const fromWordByLocale = {
    fr: 'Depuis',
    en: 'Since',
    de: 'Seit'
  } as const;

  const atWordByLocale = {
    fr: 'à',
    en: 'in',
    de: 'im'
  }

  const formatDate = (dateString: string): string => {
    return dayjs(dateString).format('DD/MM/YYYY');
  };

</script>
