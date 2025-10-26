<template>
  <LanguageSwitcher />
  <div v-for="project in projects" :key="project.id" class="mb-6">
    <h2 v-if="project.name" class="text-xl font-bold">{{ project.name[locale] }}</h2>
    <p v-if="project.description" v-html="project.description[locale]"></p>
    <a v-if="project.url" :href="project.url" target="_blank" class="text-blue-500 underline">{{projectLink}}</a>
    <div class="my-2">
      <img :src="project.main_image" :alt="project.title" class="w-[200px] mb-2"/>
      <div v-if="project.secondary_images.length" class="flex space-x-2 overflow-x-auto">
        <img v-for="(image, index) in project.secondary_images" :key="index" :src="image" :alt="`${project.title} image ${index + 1}`" class="w-[100px]"/>
      </div>
    </div>
    <div v-if="project.tags.length" class="mt-2">
      <span v-for="tag in project.tags" :key="tag.id" class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-2">
        {{ tag.name[locale] }}
      </span>
    </div>
  </div>
</template>

<!-- TODO: mettre en place la traduction sur toutes les pages -->

<script setup lang="ts">
  import LanguageSwitcher from '@/components/custom/LanguageSwitcher.vue';
import { Project } from '@/types/project';

  const props = defineProps<{
    projects: Project[];
    locale: string;
  }>();
console.log(props.projects);
  let projectLink = setProjectLinkLanguage(props.locale);

  function setProjectLinkLanguage(locale: string): string {
    switch (locale) {
      case 'en':
        return 'Learn more';
      case 'fr':
        return 'Voir le projet';
      case 'de':
        return 'Projekt ansehen';
      default:
        return 'Learn more';
    }
  }
</script>
