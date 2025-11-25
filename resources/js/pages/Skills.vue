<template>
  <div class="flex flex-col items-center justify-center">
    <div
      v-for="category in categories"
      :key="category.id"
      class="mb-8 w-1/2 borderrounded-md p-8"
    >
      <h2 class="text-3xl font-bold">
        {{ category.name[locale] }}
      </h2>
      <hr class="mb-12 mt-2 border"/>
      <ul class="grid grid-cols-3 gap-16">
        <li
          v-for="skill in category.skills"
          :key="skill.id"
          class="ml-4 flex flex-col"
        >
          <p class="text-xl font-black mb-2">
            {{ skill.name[locale] }}
          </p>
          <div
            class="h-4 bg-white rounded-full"
            :style="{
              width: `${(skill.level / 6) * 100}%`,
              background: getBarGradient(skill.level)
            }"
          />
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Category } from '@/types/category';

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
