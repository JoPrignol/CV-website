<template>
  <div v-for="project in projects" :key="project.id" class="mb-6">
    <h2 v-if="project.title" class="text-xl font-bold">{{ project.title }}</h2>
    <p v-if="project.description">{{ project.description }}</p>
    <a v-if="project.link" :href="project.link" target="_blank" class="text-blue-500 underline">Voir le projet</a>
    <div class="my-2">
      <img :src="project.main_image" :alt="project.title" class="w-[200px] mb-2"/>
      <div v-if="project.secondary_images.length" class="flex space-x-2 overflow-x-auto">
        <img v-for="(image, index) in project.secondary_images" :key="index" :src="image" :alt="`${project.title} image ${index + 1}`" class="w-[100px]"/>
      </div>
    </div>
    <div v-if="project.tags.length" class="mt-2">
      <span v-for="tag in project.tags" :key="tag.id" class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-2">
        {{ tag.name }}
      </span>
    </div>
  </div>
</template>

<script setup lang="ts">
  interface Tag {
    id: number;
    name: string;
    spotlight: boolean;
  }

  interface Project {
    id: number;
    title: string;
    description: string | null;
    link: string | null;
    main_image: string;
    secondary_images: string[];
    tags: Tag[];
  }

  const props = defineProps<{
    projects: Project[];
  }>();
</script>
