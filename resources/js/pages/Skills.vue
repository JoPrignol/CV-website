<template>
  <LanguageSwitcher />
  <div>
    <div v-for="category in categories" :key="category.id">
      <h2>{{ category.name[locale] }}</h2>
      <ul>
        <li v-for="skill in category.skills" :key="skill.id" class="ml-4">
          {{ skill.name[locale] }} — {{ displaySkillLevel(skill.level) }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Category } from '@/types/category';
import LanguageSwitcher from '@/components/custom/LanguageSwitcher.vue';

const props = defineProps<{
  categories: Category[];
  locale: string;
}>();

function displaySkillLevel(level: number){
  switch (level) {
    case 1:
      return 'Débutant';
    break;
    case 2:
      return 'Intermédiaire';
    break;
    case 3:
      return 'Avancé';
    break;
    default: return 'Unknown';
  }
}
</script>
