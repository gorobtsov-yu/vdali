<template>
  <div class="flex flex-wrap justify-between bg-white p-3 rounded-xl mb-10">
    <div>

    </div>
    <div class="flex gap-4">
      <ButtonBase
        variant="outline"
        size="sm"
        @click="$router.push({ name: 'app.employments.favorites' })"
      >
        <template #left-icon>
          <i class="fa fa-heart" aria-hidden="true"></i>
        </template>
        Избранное
      </ButtonBase>

      <ButtonBase
        variant="outline"
        size="sm"
        @click="$router.push({ name: 'app.employments.history' })"
      >
        <template #left-icon>
          <i class="fa fa-clock-o" aria-hidden="true"></i>
        </template>
        История
      </ButtonBase>
    </div>
  </div>
  <Grid
      :paginated="true"
      :url="apiUrl"
      :cols="{ mobile: 1, tablet: 2, desktop: 3, large: 4 }"
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
</template>

<script setup lang="ts">

const apiUrl = '/employments';

const requestParams = {
  metrics: true,
  limit: 8,
  interactions: true,
}
</script>