<template>
  <ShapeAnimationHP />
  <div class="flex flex-col lg:flex-row justify-between items-center align-middle w-full h-[90vh] lg:mt-0 mt-10">
    <div
      v-for="user in [props.user]"
      :key="user.id"
      class="flex flex-col w-full lg:w-1/2 items-center justify-center"
    >
      <img
        v-if="user.profile_pic_url"
        :src="user.profile_pic_url"
        alt="Joanny Prignol"
        class="w-66 mb-4 rounded-full aspect-square"
      />
      <h1 class="text-5xl font-bold mb-2 text-center">{{ user.first_name }} {{ user.last_name }}</h1>
      <p class="mb-4 text-3xl text-center">{{ user.position[locale] }}</p>
      <p class="mb-2 w-full px-2 lg:px-0 lg:w-3/4 text-center text-base" v-html="user.bio[locale]" />
      <div class="mb-4 mt-2 flex gap-2 text-3xl">
        <a
          v-if="user.linkedin_url"
          :href="user.linkedin_url"
          target="_blank"
          class="mr-4 text-moving-rainbow-slow"
        >
          <i class="fa-brands fa-linkedin icon-gradient"/>
        </a>
        <a
          v-if="user.github_url"
          :href="user.github_url"
          target="_blank"
          class="text-moving-rainbow-slow"
        >
          <i class="fa-brands fa-github icon-gradient"/>
        </a>
      </div>
    </div>
    <div class="w-full lg:w-fit flex items-center justify-center flex-grow">
      <ul class="text-2xl font-semibold space-y-4 w-full pr-6 mt-8 lg:mt-0 lg:pr-24">
        <li v-for="(section, index) in sections" :key="index" class="section-item">
          <div class="section-line bg-foreground"/>
          <Link
            :href="section.path"
            class="hover:mr-[1rem] duration-300 ease-in-out uppercase"
          >
            {{ section.label }}
          </Link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">

import { Course } from '@/types/course';
import { Experience } from '@/types/experience';
import { Project } from '@/types/project';
import { User } from '@/types/user';
import { Skill } from '@/types/skill';
import Navbar from '@/components/custom/Navbar.vue';
import { watch, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import ShapeAnimation from '@/components/custom/ShapeAnimation.vue';
import ShapeAnimationHP from '@/components/custom/ShapeAnimationHP.vue';

const props = defineProps<{
  user: User;
  categories: Skill[];
  projects: Project[];
  experiences: Experience[];
  courses: Course[];
  locale: 'fr' | 'en' | 'de' ;
}>();

const sectionsConfig = [
  { path: '/experiences', label: { fr: 'Expériences', en: 'Experiences', de: 'Berufserfahrung' } },
  { path: '/skills',      label: { fr: 'Compétences', en: 'Skills',       de: 'Fähigkeiten'    } },
  { path: '/courses',     label: { fr: 'Formation',   en: 'Education',    de: 'Ausbildung'     } },
  { path: '/projects',    label: { fr: 'Projets',     en: 'Projects',     de: 'Projekte'       } },
  { path: '/passions',    label: { fr: 'Passions',    en: 'Passions',     de: 'Hobbys'        } },
  { path: '/contact',     label: { fr: 'Contact',     en: 'Contact',      de: 'Kontakt'       } },
];


const sections = computed(() =>
  sectionsConfig.map(section => ({
    path: section.path,
    label: section.label[props.locale] || section.label.fr
  }))
);

</script>

<style scoped>
  .section-item {
    @apply flex items-center;
    text-transform: uppercase;
  }

  .section-line {
    @apply w-full h-[1px];
    margin-right: 0.5rem;
  }
</style>
