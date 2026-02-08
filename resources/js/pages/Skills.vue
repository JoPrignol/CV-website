<template>
  <ShapeAnimation />
  <div class="flex flex-col items-center justify-center mb-20">
    <div
      v-for="category in categories"
      :key="category.id"
      class="mb-8 lg:w-1/2 lg:p-8 w-full p-4"
    >
      <h2 class="text-4xl font-bold lg:mb-0 mb-4">
        {{ category.name[locale] }}
      </h2>
      <!-- <hr class="mb-12 mt-2 border"/> -->
      <ul class="grid lg:grid-cols-3 grid-cols-1 gap-16 border-2 border-foreground rounded px-6 py-10 mt-2 bg-background">
        <li
          v-for="skill in category.skills"
          :key="skill.id"
          class="ml-4 flex flex-col"
        >
          <p class="text-xl mb-2">
            {{ skill.name[locale] }}
          </p>
          <div class="relative h-4 w-full">
            <div
              class="h-4 bg-foreground rounded-full absolute top-0 left-0 z-10"
              :style="{
                width: `${(skill.level / 6) * 100}%`,
                background: getBarGradient(skill.level)
              }"
            />
            <div class="h-4 border-1 border-foreground rounded-full relative top-0 z-0 w-full"/>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Category } from '@/types/category';
import ShapeAnimation from '@/components/custom/ShapeAnimation.vue';

const props = defineProps<{
  categories: Category[];
  locale: string;
}>();

const gradientColors = [
  "#FF9000", // Orange (5%)

  "#FFE200", // Jaune (20%)

  "#C6FF1A", // Vert jaunâtre (proche du vert)
  "#91FF2A", // Vert clair
  "#5BFF3A", // Vert moyen clair
  "#32E532", // Vert moyen
  "#1CA800"  // Vert final
];


function getBarGradient(level: number) {
  // au minimum 2 couleurs (niveau 1)
  const numberOfColors = Math.min(level + 1, gradientColors.length);

  const colors = gradientColors.slice(0, numberOfColors);

  return `linear-gradient(to right, ${colors.join(", ")})`;
}


</script>
