<template>
  <div class="flex flex-col gap-12 items-center justify-center">
    <div
      v-for="project in projects"
      :key="project.id"
      class="w-1/2 border border-white rounded-md p-8"
    >
      <div v-if="project.tags.length" class="mb-1 w-full flex justify-end">
        <button
          v-for="tag in project.tags"
          :key="tag.id"
          class="inline-block font-medium text-sm px-2 py-1 rounded-full border mr-2 text-black bg-white hover:bg-black hover:text-white duration-150 ease-in-out"
        >
          {{ tag.name[locale] }}
        </button>
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
        class="text-xl mt-4 flex gap-2 items-center w-fit text-moving-rainbow mb-4 font-black"
      >
        <i class="fa-solid fa-angles-right" />
        <span>{{projectLink}}</span>
      </a>

      <div class="my-2">
        <Carousel
          v-bind="carouselConfig"
          :autoplay="3000"
          :pause-autoplay-on-hover="true"
          slide-effect="fade"
          :mouseWheel="true"
        >
          <!-- Slide pour l'image principale -->
          <Slide v-if="project.main_image_url">
            <img
              :src="project.main_image_url"
              :alt="project.title"
              class="w-full h-fit object-cover rounded-md"
            />
          </Slide>

          <!-- Slides pour les images secondaires -->
          <Slide
            v-for="(image, index) in project.secondary_images_urls"
            :key="index"
          >
            <img
              :src="image"
              :alt="`${project.title} image ${index + 1}`"
              class="w-full h-fit object-cover rounded-md"
            />
          </Slide>

          <!-- Navigation et pagination -->
          <!-- <template #addons>
            <Navigation />
            <Pagination />
          </template> -->
        </Carousel>
      </div>


    </div>
  </div>
</template>

<script setup lang="ts">
  import { Project } from '@/types/project';

  import 'vue3-carousel/carousel.css'
  import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

  const carouselConfig = {
    itemsToShow: 1,
    wrapAround: true, // Boucle infinie
    transition: 3000, // Durée de la transition en ms
    snapAlign: 'start', // Alignement des slides
  }

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

<style scoped>
.text-moving-rainbow {
  color: white;
  background: linear-gradient(90deg, #00C0FF 0%, #FFCF00 49%, #FC4F4F 80%, #00C0FF 100%);
  background-clip: text;
  -webkit-background-clip: text;
}

.text-moving-rainbow:hover {
  color: transparent;
  transition: 500ms ease;
  animation:slidebg 10s linear infinite;
}

@keyframes slidebg {
  to {
    background-position:20vw;
  }
}
</style>
