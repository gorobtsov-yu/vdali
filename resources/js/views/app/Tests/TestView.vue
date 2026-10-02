<template>
  <component :is="testComponent" :code="code" />
</template>

<script setup lang="ts">
import { defineAsyncComponent, computed } from 'vue';
import { testComponentRegistry } from '@/js/static/tests/registry';

const props = defineProps<{ code: string }>();

const testComponent = computed(() => {
  const loader = testComponentRegistry[props.code] || testComponentRegistry.default;
  return defineAsyncComponent(loader);
});
</script>