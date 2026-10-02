<template lang="">
    <Grid
    :paginated="true"
    :url="apiUrl"
    :cols="{ mobile: 1, tablet: 2, desktop: 3 }"
    :gap="20"
    :params="requestParams"
    :centered="true"
    :min-width="200"
  >
    <template #default="{ items }">
      <TestCard
        v-for="test in tests"
        :key="test.id"
        :test="test"
      />
      <TestCard
        v-for="test in items"
        :key="test.id"
        :test="test"
      />
    </template>
  </Grid>
</template>
<script setup lang="ts">
import { tests } from '@/js/static/tests/tests';

const apiUrl = '/tests';

const requestParams = {
  metrics: true,
  limit: 8,
}
</script>