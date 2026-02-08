<template>
  <CurvesAnimation />
  <div class="flex flex-col gap-12 items-center justify-center mb-20 px-4 lg:px-0">
    <div v-if="sortedTags.length" class="lg:w-1/2 w-full items-center justify-center flex gap-4 flex-wrap mb-6 mt-8 lg:mt-4">
      <span class="text-2xl font-bold self-center w-fit">
        Tags :
      </span>
      <a
        v-for="tag in sortedTags"
        :key="tag.id"
        :href="`?tag=${tag.id}`"
        class="inline-block h-8 text-sm px-3 py-1 rounded-full duration-150 ease-in-out font-bold"
        :class="activeTag === tag.id ? 'text-black bg-custom-gradient border-none' : 'border border-foreground text-black bg-foreground hover:bg-black hover:text-foreground'"
        @click.prevent="onTagClick(tag.id)"
      >
        {{ tag.name[locale] }}
      </a>
    </div>
    <div
      v-for="project in filteredProjects"
      :key="project.id"
      class="lg:w-1/2 w-full border-2 border-foreground rounded-md px-4 py-6 lg:px-8 lg:py-8 bg-background"
    >
      <div v-if="project.tags.length" class="mb-1 w-full flex justify-end flex-wrap">
        <a
          v-for="tag in project.tags"
          :key="tag.id"
          :href="`?tag=${tag.id}`"
          class="inline-block lg:text-sm text-xs lg:mb-0 mb-4 px-3 py-1 rounded-full mr-2 duration-150 ease-in-out font-bold"
          :class="activeTag === tag.id ? 'text-black bg-custom-gradient border-none' : 'border border-foreground text-black bg-foreground hover:bg-black hover:text-foreground'"
          @click.prevent="onTagClick(tag.id)"
        >
          {{ tag.name[locale] }}
        </a>
      </div>

      <h2
        v-if="project.name"
        class="text-3xl text-center lg:text-left font-bold"
      >
        {{ project.name[locale] }}
      </h2>
      <p
        v-if="project.description"
        v-html="project.description[locale]"
        class="mt-4 text-base lg:text-left text-justify"
      />
      <a
        v-if="project.url"
        :href="project.url"
        target="_blank"
        class="text-xl mt-4 flex gap-2 items-center w-fit text-moving-rainbow mb-4 font-black"
      >
        <i class="fa-solid fa-angles-right" />
        <span>
          {{projectLink}}
        </span>
      </a>

      <div class="my-2">
        <Carousel
          v-bind="carouselConfig"
          :autoplay="2500"
          :pause-autoplay-on-hover="true"
          slide-effect="fade"
        >
          <!-- Slide pour l'image principale -->
          <Slide v-if="project.main_image_url">
            <img
              :src="project.main_image_url"
              :alt="project.name"
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
              :alt="`${project.name} image ${index + 1}`"
              class="w-full h-fit object-cover rounded-md"
            />
          </Slide>
        </Carousel>
      </div>


    </div>
  </div>
</template>

<script setup lang="ts">
  import { Project } from '@/types/project';
  import { Tag } from '@/types/tag';

  import 'vue3-carousel/carousel.css'
  import { Carousel, Slide } from 'vue3-carousel'
  import { ref } from 'vue';
  import { computed } from 'vue';
  import { router } from '@inertiajs/vue3';
import CurvesAnimation from '@/components/custom/CurvesAnimation.vue';

  const carouselConfig = {
    itemsToShow: 1,
    wrapAround: true, // Boucle infinie
    transition: 2500, // Durée de la transition en ms
    snapAlign: 'start', // Alignement des slides
  }

  const props = defineProps<{
    projects: Project[];
    tags: Tag[];
    locale: string;
    initialActiveTag: string | number | null;
  }>();

  const sortedTags = computed(() => {
    return [...props.tags].sort((a, b) => {
      if (a.spotlight && !b.spotlight) return -1;
      if (!a.spotlight && b.spotlight) return 1;
      return 0;
    });
  });

  const projectLink = setProjectLinkLanguage(props.locale);

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

  const activeTag = ref<any>(
    props.initialActiveTag ? Number(props.initialActiveTag) : null
  );

  function onTagClick(tagId: any) {
    const currentUrl = window.location.pathname
    let newQueryString = {}

    // Si l’utilisateur clique sur le même tag, le filtre est retiré
    if (activeTag.value == tagId) {
      activeTag.value = null
    } else {
      newQueryString = { tag: tagId }
      activeTag.value = tagId
    }

    // Mise à jour des données et de l'utl grâce à router.get()
    router.get(
      currentUrl, // L'url de base sans les paramètres
      newQueryString, // Les paramètres
      {
        preserveScroll: true,
        preserveState: true,
        replace: true,
      }
    )
  }

  const filteredProjects = computed(() => {
    let projects = props.projects;
    if (activeTag.value) {
      projects = projects.filter(project =>
        project.tags.some(tag => tag.id == activeTag.value)
      );
    }
    // Afficher les projets avec un tag spotlight en premier
    return [...projects].sort((a, b) => {
      const aHasSpotlight = a.tags.some(tag => tag.spotlight);
      const bHasSpotlight = b.tags.some(tag => tag.spotlight);
      if (aHasSpotlight && !bHasSpotlight) return -1;
      if (!aHasSpotlight && bHasSpotlight) return 1;
      return 0;
    });
  });

</script>

<style scoped>
  .bg-custom-gradient {
    background: linear-gradient(90deg, #FC4F4F 25%, #FFCF00 80%, #bbff00 100%);
  }

  .bg-custom-gradient:hover {
    scale: 1.02;
    transition: 200ms ease-in-out;
  }
</style>
