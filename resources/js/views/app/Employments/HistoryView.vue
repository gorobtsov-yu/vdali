<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">История просмотров</h1>

    <Grid
      :paginated="true"
      :url="apiUrl"
      :cols="{ mobile: 1, tablet: 2, desktop: 4, large: 4 }"
      :gap="20"
      :params="requestParams"
      :centered="true"
      :min-width="200"
    >
      <template #default="{ items }">
        <div v-for="employment in items">
          <EmploymentCard
            :key="employment.id"
            :employment="employment"
          />
        </div>
      </template>
    </Grid>
  </div>
</template>
<script setup lang="ts">
const apiUrl = '/history/employments';

const requestParams = {
  limit: 8,
};
</script>