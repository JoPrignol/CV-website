<template>
  <div class="flex flex-col gap-12 items-center justify-center">
    <div
      v-for="project in projects"
      :key="project.id"
      class="w-1/2 border border-white rounded-md p-8"
    >
      <div v-if="project.tags.length" class="mb-1 w-full flex justify-end">
        <span
          v-for="tag in project.tags"
          :key="tag.id"
          class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-2"
        >
          {{ tag.name[locale] }}
        </span>
      </div>

      <h2
        v-if="project.name"
        class="text-3xl font-bold"
      >
        {{ project.name[locale] }}
      </h2>
      <p
        v-if="project.description"
        v-html="project.description[locale]"
        class="mt-4"
      />
      <a
        v-if="project.url"
        :href="project.url"
        target="_blank"
        class="text-xl mt-4 flex gap-2 items-center"
      >
        <i class="fa-solid fa-angles-right" style="color: #ffffff;" />
        <span>{{projectLink}}</span>
      </a>


      <div class="my-2">
        <img
          :src="project.main_image_url"
          :alt="project.title"
          class="w-[15rem] aspect-auto mb-2"
        />
        <div
          v-if="project.secondary_images_urls"
          class="flex space-x-2 overflow-x-auto gap-8"
        >
          <img
            v-for="(image, index) in project.secondary_images_urls"
            :key="index"
            :src="image"
            :alt="`${project.title} image ${index + 1}`"
            class="h-[10rem] aspect-auto"
          />
        </div>
      </div>


    </div>
  </div>
</template>

<script setup lang="ts">
import { Project } from '@/types/project';

  const props = defineProps<{
    projects: Project[];
    locale: string;
  }>();
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
