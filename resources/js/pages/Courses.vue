<template>
  <LanguageSwitcher />
  <div v-for="course in courses" :key="course.id" class="mb-6">
    <h2 class="text-xl font-bold">{{ course.title[locale] }} ({{ course.school.name[locale] }})</h2>
    <p v-if="course.start_date && course.end_date">{{ formatDate(course.start_date) }} - {{ formatDate(course.end_date) }}</p>
    <p v-else-if="formatDate(course.start_date)">Depuis {{ course.start_date }}</p>
    <p v-if="course.description" v-html="course.description[locale]" />
    <img v-if="course.school.logo" :src="course.school.logo" :alt="course.school.name" class="w-[50px]"/>
  </div>
</template>
<script setup lang="ts">
  import { Course } from '@/types/course';
  import dayjs from 'dayjs';
  import LanguageSwitcher from '@/components/custom/LanguageSwitcher.vue';

  const props = defineProps<{
    courses: Course[];
    locale: string;
  }>();

  const formatDate = (dateString: string): string => {
    return dayjs(dateString).format('DD/MM/YYYY');
  };

</script>
