<template>
  <!-- <Navbar :locale="locale"/> -->
  <div
    v-for="user in [props.user]"
    :key="user.id"
    class="flex flex-col w-full items-center justify-center"
  >
    <img
      v-if="user.profile_pic_url"
      :src="user.profile_pic_url"
      alt="Joanny Prignol"
      class="w-48 mb-4 rounded-full aspect-square"
    />
    <h1 class="text-5xl font-bold mb-4">{{ user.first_name }} {{ user.last_name }}</h1>
    <p class="mb-2 text-3xl">{{ user.position[locale] }}</p>
    <p class="mb-2 w-3/4 text-center" v-html="user.bio[locale]" />
    <div class="mb-4 flex">
      <a v-if="user.linkedin_url" :href="user.linkedin_url" target="_blank" class="text-blue-500 mr-4"><i class="fa-brands fa-linkedin fa-xl" style="color: #ffffff;"></i></a>
      <a v-if="user.github_url" :href="user.github_url" target="_blank" class="text-blue-500"><i class="fa-brands fa-github fa-xl" style="color: #ffffff;"></i></a>
    </div>
  </div>
</template>

<script setup lang="ts">

import { Course } from '@/types/course';
import { Experience } from '@/types/experience';
import { Project } from '@/types/project';
import { User } from '@/types/user';
import { Skill } from '@/types/skill';
import Navbar from '@/components/navbar.vue';

const props = defineProps<{
  user: User;
  categories: Skill[];
  projects: Project[];
  experiences: Experience[];
  courses: Course[];
  locale: string;
}>();

</script>
