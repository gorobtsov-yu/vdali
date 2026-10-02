<template>
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
      <VacancyCard
        v-for="vacancy in items"
        :key="vacancy.id"
        :vacancy="vacancy"
      />
    </template>
  </Grid>
</template>

<script setup lang="ts">

const apiUrl = '/vacancies';

const requestParams = {
  metrics: true,
  limit: 8,
}
</script>