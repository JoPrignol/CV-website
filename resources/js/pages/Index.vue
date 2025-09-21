
<template>
  <div class="w-full h-full bg-red-500">
    <p>hello</p>
    <ul>
      <li v-for="post in posts" :key="post.id">
        {{ post.title }}: {{ post.content }}
      </li>
    </ul>
  </div>
</template>

  <script setup lang="ts">
  defineProps({
    posts: {
      type: Object,
      required: true,
    },
  })
  </script>
