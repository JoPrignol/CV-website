<template>
  <LanguageSwitcher />
  <div v-for="exp in experiences" :key="exp.id">
    <h2>
      <span v-if="exp.position">
        {{ exp.position[locale] }}
      </span>
      <span v-if="exp.company">
        ({{ exp.company.name[locale] }})
      </span>
    </h2>
    <p v-if="exp.location">{{ exp.location[locale] }}</p>
    <p v-if="exp.end_date">{{ formatDate(exp.start_date) }} - {{ formatDate(exp.end_date) }}</p>
    <p v-else>Depuis {{ formatDate(exp.start_date) }}</p>
    <p v-html="exp.description[locale]" />
    <img v-if="exp.company.logo" :src="exp.company.logo" :alt="exp.company.name" class="w-[50px]"/>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Experience } from '@/types/experience';
import LanguageSwitcher from '@/components/custom/LanguageSwitcher.vue';
import dayjs from 'dayjs';

  const props = defineProps<{
    experiences: Experience[];
    locale: string;
  }>();

  const formatDate = (dateString: string): string => {
    return dayjs(dateString).format('DD/MM/YYYY');
  };

</script>
