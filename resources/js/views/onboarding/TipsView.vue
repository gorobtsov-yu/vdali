<template>
  <div class="max-w-2xl mx-auto px-4 py-8 flex flex-col items-center min-h-[80vh] justify-center">
    <div class="w-full">
      <div class="flex justify-between items-center mb-4">
        <span class="text-sm text-gray-500">Шаг {{ currentStep + 1 }} из {{ tips.length }}</span>
        <span class="text-sm font-medium text-blue-600">{{ Math.round(((currentStep + 1) / tips.length) * 100) }}%</span>
      </div>
      <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden mb-6">
        <div
          class="h-full bg-blue-500 rounded-full transition-all duration-300"
          :style="{ width: `${((currentStep + 1) / tips.length) * 100}%` }"
        />
      </div>

      <OnboardingTipCard
        v-if="currentRecommendation"
        :title="currentRecommendation.title"
        :description="currentRecommendation.description"
        :image-url="currentRecommendation.imageUrl"
      />

      <div class="flex justify-between mt-6">
        <button
          v-if="currentStep > 0"
          @click="prevStep"
          class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
        >
          Назад
        </button>
        <div v-else></div>

        <button
          v-if="!isLastStep"
          @click="nextStep"
          class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
        >
          Далее →
        </button>
        <button
          v-else
          @click="finishOnboarding"
          class="px-8 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors"
        >
          К рекомендациям
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/js/stores/user';

const router = useRouter();
const userStore = useUserStore();

const tips = ref([
  {
    id: 1,
    title: 'Персональные рекомендации',
    description: 'На основе Ваших ответов мы подобрали занятости, которые примерно соответствуют вашим интересам и навыкам.',
    imageUrl: 'https://picsum.photos/seed/rec1/800/400',
  },
  {
    id: 2,
    title: 'Актуальные вакансии',
    description: 'Просматривайте актуальные предложения от различных компаний, которые ищут специалистов вашего профиля.',
    imageUrl: 'https://picsum.photos/seed/rec2/800/400',
  },
  {
    id: 3,
    title: 'Аналитика вашего профиля',
    description: 'Сравнивайте свои навыки с требованиями рынка и получайте рекомендации по развитию от персонального ассистента GigaChat.',
    imageUrl: 'https://picsum.photos/seed/rec3/800/400',
  },
  {
    id: 4,
    title: 'Сообщество и поддержка',
    description: 'Изучите себя и расскройте свои интересы вместе с сотнями пользователей!',
    imageUrl: 'https://picsum.photos/seed/rec4/800/400',
  },
]);

const currentStep = ref(0);

const currentRecommendation = computed(() => tips.value[currentStep.value]);
const isLastStep = computed(() => currentStep.value === tips.value.length - 1);

const nextStep = () => {
  if (currentStep.value < tips.value.length - 1) {
    currentStep.value++;
  }
};

const prevStep = () => {
  if (currentStep.value > 0) {
    currentStep.value--;
  }
};

const finishOnboarding = () => {
  userStore.onboardingCompleted = true;
  router.push({ name: 'app.progress' });
};
</script>