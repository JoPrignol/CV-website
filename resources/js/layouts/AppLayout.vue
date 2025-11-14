<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import Navbar from '@/components/custom/Navbar.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <!-- <AppLayout :breadcrumbs="breadcrumbs"> -->
        <Navbar :locale="locale"/>
        <div>
          <slot />
        </div>

</template>
