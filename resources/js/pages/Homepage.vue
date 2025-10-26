<template>
  <div v-for="user in [props.user]" :key="user.id">
    <h1 class="text-3xl font-bold mb-4">Welcome to {{ user.first_name }}'s Portfolio</h1>
    <p class="mb-2">Position: {{ user.position }}</p>
    <p class="mb-2">Bio: {{ user.bio }}</p>
    <p class="mb-2">Email: {{ user.email }}</p>
    <p class="mb-2">Phone: {{ user.phone_number }}</p>
    <div class="mb-4">
      <a v-if="user.linkedin_url" :href="user.linkedin_url" target="_blank" class="text-blue-500 mr-4">LinkedIn</a>
      <a v-if="user.github_url" :href="user.github_url" target="_blank" class="text-blue-500">GitHub</a>
    </div>
    <img v-if="user.profile_pic" :src="user.profile_pic" alt="Profile Picture" class="w-32 h-32 rounded-full mb-4">
  </div>
</template>

<script setup lang="ts">

import { Course } from '@/types/course';
import { Experience } from '@/types/experience';
import { Project } from '@/types/project';
import { User } from '@/types/user';
import { Skill } from '@/types/skill';

const props = defineProps<{
  user: User;
  categories: Skill[];
  projects: Project[];
  experiences: Experience[];
  courses: Course[];
  locale: string;
}>();

</script>
