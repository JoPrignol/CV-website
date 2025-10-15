<template>
  <div>Passions Page</div>
  <div v-for="passion in passions" :key="passion.id" class="mb-6">
    <h2 class="text-xl font-bold mb-2">{{ passion.name }}</h2>
    <p class="mb-2">{{ passion.description }}</p>
    <img v-if="passion.image" :src="passion.image" :alt="passion.name" class="w-full h-auto rounded" />
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Passion } from '@/types/passion';

const props = defineProps<{
  passions: Passion[];
}>();
</script>
