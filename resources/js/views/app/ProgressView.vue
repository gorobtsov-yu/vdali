<template>
  <div class="flex justify-center items-center w-full flex-col">
    <!-- <model-viewer
      class="w-[50%] h-100 m-auto"
      alt="House"
      :src="house"
      ar
      loading="eager"
      shadow-intensity="2"
      camera-orbit="20rad 1.1rad 1rad"
      camera-controls
      touch-action="pan-y"
    > -->
    <img class="lg:w-[50%] md:w-[100%]" :src="loadHome()" alt="House image"/>
      <!-- <template v-slot:progress-bar>
        <div style="display: none;"></div>
      </template> -->
    <!-- </model-viewer> -->

    <span class="m-3 text-lg w-full p-4">Рекомендуемые занятости</span>

    <Grid
      :cols="{ mobile: 1, tablet: 2, desktop: 3, large: 3 }"
      :gap="20"
      :centered="true"
      :min-width="200"
    >
        <div
          v-for="employment in items"
          :key="employment.id"
        >
          <RecommendationEmploymentCard
            :employment="employment"
          />
        </div>
    </Grid>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import api from '@/js/services/axios';
import { IndexEmployment } from '@/js/types/employment';
import { userService } from '@/js/services/user';

const items = ref<IndexEmployment[]>([]);
const houseImages = import.meta.glob<{ default: string }>('/resources/images/house_1/house*.png', { eager: true });

const fetchRecommendations = async () => {
  try {
    const response = await api.get('/recommendations/employments', {
      params: {
        limit: 6,
        interactions: true,
      },
    });

    const data = (response.data || []) as IndexEmployment[];
    const realItems = data.slice(0, 6);

    items.value = realItems;
  } catch (error) {
    console.error('Recommendations fetch error:', error);
  }
};

const loadHome = () => {
  const level = userService.getLevel(items.value) + 1;
  const path = `/resources/images/house_1/house${level}.png`;
  console.log(houseImages)

  return houseImages[path]?.default;
}

onMounted(() => {
  fetchRecommendations();
});
</script>