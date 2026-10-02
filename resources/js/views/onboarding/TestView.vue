<template>
  <AssociativeTestView :is-onboarding="true" @completed="onTestCompleted" />
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';
import AssociativeTestView from '@/js/views/app/Tests/AssociativeTestView.vue';

const router = useRouter();

const onTestCompleted = () => {
  router.push({ name: 'onboarding.salary' });
};
</script>