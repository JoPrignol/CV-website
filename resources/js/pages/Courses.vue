<template>
  <div v-for="course in courses" :key="course.id" class="mb-6">
    <h2 class="text-xl font-bold">{{ course.title }} ({{ course.school.name }})</h2>
    <p v-if="course.start_date && course.end_date">{{ course.start_date }} - {{ course.end_date }}</p>
    <p v-else-if="course.start_date">Depuis {{ course.start_date }}</p>
    <p v-if="course.description">{{ course.description }}</p>
    <img v-if="course.school.logo" :src="course.school.logo" :alt="course.school.name" class="w-[50px]"/>
  </div>
</template>
<script setup lang="ts">
  interface School {
    id: number;
    name: string;
    logo: string | null;
    website: string | null;
  }
  interface Course {
    id: number;
    title: string;
    description: string | null;
    start_date: string | null;
    end_date: string | null;
    school: School;
  }

  const props = defineProps<{
    courses: Course[];
  }>();
</script>
