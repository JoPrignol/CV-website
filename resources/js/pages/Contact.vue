<template>
  <div>{{ userContact.email }}</div>
  <div>{{ userContact.github_url }}</div>
  <div>{{ userContact.linkedin_url }}</div>
  <div>{{ userContact.phone_number }}</div>
</template>

<script setup lang="ts">
defineProps<{
  userContact: {
    email: string;
    github_url: string;
    linkedin_url: string;
    phone_number: string;
  };
}>();
</script>
