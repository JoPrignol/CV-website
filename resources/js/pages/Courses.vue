<template>
  <div class="flex flex-col gap-12 items-center justify-center">
    <div
      v-for="course in courses" :key="course.id"
      class="w-1/2 border border-white rounded-md p-8"
    >
      <div class="flex flex-row gap-4">
        <a
          v-if="course.school.website_url"
          :href="course.school.website_url"
          target="_blank"
          rel="noopener noreferrer"
        >
          <img
            v-if="course.school.logo"
            :src="course.school.logo"
            :alt="course.school.name"
            class="w-[50px] aspect-square"
          />
        </a>
        <img
          v-else
          :src="course.school.logo"
          :alt="course.school.name"
          class="w-[50px] aspect-square"
        />
        <div>
          <h2 class="text-3xl font-bold">
            <span v-if="course.title">
              {{ course.title[locale] }}
            </span>
            <span> - </span>
            <span v-if="course.school">
              {{ course.school.name[locale] }}
            </span>
          </h2>
          <p
            v-if="course.start_date"
            class="text-xl"
          >
            <span v-if="course.end_date">{{ formatDate(course.start_date) }} - {{ formatDate(course.end_date) }}</span>
            <span v-else>{{fromWordByLocale[locale]}} {{ formatDate(course.start_date) }}</span>
          </p>
        </div>
      </div>

      <p
        v-if="course.description"
        v-html="course.description[locale]"
        class="mt-4 text-justify"
      />

    </div>
  </div>
</template>
<script setup lang="ts">
  import { Course } from '@/types/course';
  import dayjs from 'dayjs';
  import { Link } from '@inertiajs/vue3';


  const props = defineProps<{
    courses: Course[];
    locale: 'fr' | 'en' | 'de';
  }>();

  const formatDate = (dateString: string): string => {
    return dayjs(dateString).format('DD/MM/YYYY');
  };

  const fromWordByLocale = {
    fr: 'Depuis',
    en: 'Since',
    de: 'Seit'
  } as const;

</script>
