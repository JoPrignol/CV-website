<template>
  <div class="flex flex-col gap-12 items-center justify-center mb-20 lg:px-0 px-4">
    <div
      v-for="exp in experiences" :key="exp.id"
      class="lg:w-1/2 w-full border-2 border-foreground rounded-md p-8 bg-background"
    >
      <div class="block lg:hidden w-full mb-6">
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
            class="w-full aspect-auto"
          />
        </a>
        <img
          v-else
          :src="exp.company.logo_url"
          :alt="exp.company.name"
          class="w-full aspect-auto"
        />
      </div>
      <div class="flex flex-row gap-4">
        <div class="hidden lg:block">
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
              class="w-[50px] aspect-auto"
            />
          </a>
          <img
            v-else
            :src="exp.company.logo_url"
            :alt="exp.company.name"
            class="w-[50px] aspect-auot"
          />
        </div>
        <div>
          <h2 class="text-3xl font-bold text-center lg:text-left mb-4">
            <span v-if="exp.position">
              {{ exp.position[locale] }}
            </span>
            <br class="block lg:hidden"/>
            <span> - </span>
            <br class="block lg:hidden"/>
            <span v-if="exp.company">
              {{ exp.company.name[locale] }}
            </span>
          </h2>
          <p class="text-xl mt-8 lg:mt-0">
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
        class="lg:mt-4 mt-8 text-justify text-base"
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
