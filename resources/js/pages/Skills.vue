<template>
  <div>
    <div v-for="category in categories" :key="category.id">
      <h2>{{ category.name }}</h2>
      <ul>
        <li v-for="skill in category.skills" :key="skill.id" class="ml-4">
          {{ skill.name }} — {{ displaySkillLevel(skill.level) }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">

interface Skill {
  id: number;
  name: string;
  level: number;
}

interface Category {
  id: number;
  name: string;
  skills: Skill[];
}

const props = defineProps<{
  categories: Category[]
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
