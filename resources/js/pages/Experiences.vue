<template>
  <div v-for="exp in experiences" :key="exp.id">
    <h2>{{ exp.title }} ({{ exp.company.name }})</h2>
    <p>{{ exp.localisation }}</p>
    <p v-if="exp.end_date">{{ exp.start_date }} - {{ exp.end_date }}</p>
    <p v-else>Depuis {{ exp.start_date }}</p>
    <p>{{ exp.description }}</p>
    <img v-if="exp.company.logo" :src="exp.company.logo" :alt="exp.company.name" class="w-[50px]"/>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Experience } from '@/types/experience';

  const props = defineProps<{
    experiences: Experience[];
    locale: string;
  }>();
</script>
