<template>
  <div class="w-full flex items-center px-4 py-4" :class="isHomePage ? 'justify-end' : 'justify-between'">
    <a
      v-if="!isHomePage"
      class="text-xl font-bold" href="/"
    >
      <i class="fa-solid fa-arrow-left" style="color: #ffffff;" />
      {{localHome}}
    </a>
    <LanguageSwitcher />
  </div>
</template>

<script setup lang="ts">
import LanguageSwitcher from './custom/LanguageSwitcher.vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps<{
  locale: string;
}>();

const page = usePage();
const isHomePage = page.url === '/';

let localHome = 'HOME';

if (props.locale === 'fr') {
  localHome = 'ACCUEIL';
} else {
  localHome = 'HOME';
}

</script>
