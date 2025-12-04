<template>
  <div class="flex flex-col gap-12 items-center justify-center mb-20">
    <img
      v-if="userContact.profile_pic_url"
      :src="userContact.profile_pic_url"
      alt="Joanny Prignol"
      class="w-68 rounded-full aspect-square"
    />
    <div class="flex flex-col items-center justify-center">

      <h2 class="text-4xl font-bold mb-8">{{ contactText[locale] }}</h2>

      <a
        target="_blank"
        :href="`mailto:${userContact.email}`"
        class="text-xl font-black mb-4 text-moving-rainbow"
      >
        <i class="fa-solid fa-envelope fa-xl mr-2"></i>
        {{userContact.email}}
      </a>

      <a
        target="_blank"
        :href="`tel:${userContact.phone_number}`"
        class="text-xl font-black mb-6 text-moving-rainbow"
      >
        <i class="fa-solid fa-phone fa-md mr-2"></i>
        {{userContact.phone_number}}
      </a>

        <div class="flex gap-8 mb-6 text-xl">
          <a target="_blank" :href="userContact.linkedin_url">
            <i class="fa-brands fa-linkedin fa-2xl text-moving-rainbow-slow icon-gradient"></i>
          </a>
          <a target="_blank" :href="userContact.github_url">
            <i class="fa-brands fa-github fa-2xl text-moving-rainbow-slow icon-gradient"></i>
          </a>
        </div>
</div>
  </div>
</template>

<script setup lang="ts">

  const props = defineProps<{
    userContact: {
      email: string;
      github_url: string;
      linkedin_url: string;
      phone_number: string;
      locale: string;
      profile_pic_url: string;
    };
    locale: 'fr' | 'en' | 'de';
  }>();

  const contactText = {
    fr: 'Vous souhaitez me contacter ?',
    en: 'You would like to contact me?',
    de: 'Möchten Sie mich kontaktieren?',
  };

</script>
