<template>
  <DualCurvesAnimation />
  <div class="flex flex-col gap-12 items-center justify-center mb-20 px-4 lg:px-0">
    <div
      v-for="course in courses" :key="course.id"
      class="lg:w-1/2 w-full border-2 border-foreground rounded-md lg:p-8 p-4 bg-background"
    >
      <div class="block lg:hidden w-full mb-6">
        <a
          v-if="course.school.website_url"
          :href="course.school.website_url"
          target="_blank"
          rel="noopener noreferrer"
        >
          <img
            v-if="course.school.logo_url"
            :src="course.school.logo_url"
            :alt="course.school.name"
            class="w-full aspect-auto"
          />
        </a>
        <img
          v-else
          :src="course.school.logo_url"
          :alt="course.school.name"
          class="w-full aspect-auto"
        />
      </div>
      <div class="flex flex-row gap-4">
        <div  class="hidden lg:block">
          <a
            v-if="course.school.website_url"
            :href="course.school.website_url"
            target="_blank"
            rel="noopener noreferrer"
          >
            <img
              v-if="course.school.logo_url"
              :src="course.school.logo_url"
              :alt="course.school.name"
              class="w-[50px] aspect-square"
            />
          </a>
          <img
            v-else
            :src="course.school.logo_url"
            :alt="course.school.name"
            class="w-[50px] aspect-square"
          />
        </div>
        <div class="w-full">
          <h2 class="text-3xl font-bold lg:text-left text-center mb-4">
            <span v-if="course.title">
              {{ course.title[locale] }}
            </span>
            <br class="block lg:hidden"/>
            <span> - </span>
            <br class="block lg:hidden"/>
            <span v-if="course.school">
              {{ course.school.name[locale] }}
            </span>
          </h2>
          <p
            v-if="course.start_date"
            class="lg:text-xl text-lg lg:my-0 my-8 text-center lg:text-left"
          >
            <span v-if="course.end_date">{{ formatDate(course.start_date) }}
            -
            {{ formatDate(course.end_date) }}</span>
            <span v-else>{{fromWordByLocale[locale]}} {{ formatDate(course.start_date) }}</span>
          </p>
        </div>
      </div>

      <p
        v-if="course.description"
        v-html="course.description[locale]"
        class="mt-4 text-justify text-base"
      />

    </div>
  </div>
</template>
<script setup lang="ts">
  import { Course } from '@/types/course';
  import dayjs from 'dayjs';
  import { Link } from '@inertiajs/vue3';
  import DualCurvesAnimation from '@/components/custom/DualCurvesAnimation.vue';


  const props = defineProps<{
    courses: Course[];
    locale: 'fr' | 'en' | 'de';
  }>();

  const formatDate = (dateString: string): string => {
    return dayjs(dateString).format('MM/YYYY');
  };

  const fromWordByLocale = {
    fr: 'Depuis',
    en: 'Since',
    de: 'Seit'
  } as const;

</script>
