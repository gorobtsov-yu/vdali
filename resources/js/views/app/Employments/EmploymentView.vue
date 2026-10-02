<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div v-if="loading" class="flex justify-center items-center min-h-[400px]">
      <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"></div>
    </div>

    <div v-else-if="error" class="text-center py-12">
      <p class="text-red-500">{{ error }}</p>
      <button 
        @click="fetchData" 
        class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
      >
        Повторить
      </button>
    </div>

    <template v-else-if="employment && user">
      <div class="mb-6">
        <div class="flex items-center justify-between gap-3 flex-wrap">
          <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ employment.name }}</h1>
          <button
            @click="toggleFavorite"
            class="text-3xl transition-transform hover:scale-110 active:scale-95"
            :disabled="favoriteLoading"
          >
            <i
              class="fa"
              :class="[employment.is_favorite ? 'fa-heart text-red-500' : 'fa-heart-o text-gray-400']"
              aria-hidden="true"
            ></i>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6 mb-8">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 relative overflow-hidden">
          <div
            class="absolute inset-0 bg-cover bg-center opacity-40"
            :style="{ backgroundImage: `url('https://picsum.photos/seed/${employment.id}/800/400')` }"
          ></div>
          <div class="relative z-10 p-4 rounded-lg backdrop-blur-sm">
            <h2 class="text-lg font-semibold text-gray-900 mb-3">Описание</h2>
            <p class="text-gray-700 leading-relaxed">{{ employment.description }}</p>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 flex items-center flex-col justify-center">
          <h2 class="text-lg font-semibold text-gray-900 mb-3">Зарплатная вилка</h2>
          <div class="flex items-baseline gap-2">
            <span class="text-2xl font-bold text-emerald-600">{{ formatSalary(employment.salary_from) }}</span>
            <span class="text-gray-400">—</span>
            <span class="text-2xl font-bold text-emerald-600">{{ formatSalary(employment.salary_to) }}</span>
          </div>
        </div>
      </div>
      
      <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-1 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Ограничения</h2>
          <div class="backdrop-blur-sm bg-gray-100 w-full p-4 flex justify-center items-center text-center min-h-20 rounded-lg">
            <i class="w-[60%] text-sm">Здесь будут описаны трудности, с которыми можно будет столкнуться</i>
          </div>
        </div>
        <div class="bg-white lg:col-span-2 rounded-xl shadow-sm p-6 mb-8">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Рекомендации к образованию</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h3 class="text-sm font-medium text-gray-500 mb-2">Уровень образования</h3>
              <div v-if="employment.education_levels.length === 0" class="text-gray-400 text-sm">
                Не указано
              </div>
              <div v-else class="flex flex-wrap gap-2">
                <span 
                  v-for="level in employment.education_levels" 
                  :key="level.id"
                  class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
                >
                  {{ level.name }}
                </span>
              </div>
            </div>
            <div>
              <h3 class="text-sm lg:col-span-2 font-medium text-gray-500 mb-2">Сфера образования</h3>
              <div v-if="employment.education_spheres.length === 0" class="text-gray-400 text-sm">
                Не указано
              </div>
              <div v-else class="flex flex-wrap gap-2">
                <span 
                  v-for="sphere in employment.education_spheres" 
                  :key="sphere.id"
                  class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm"
                >
                  {{ sphere.name }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Сравнение характеристик</h2>
        
        <div v-if="employment.characteristics.length === 0" class="text-gray-400 text-sm">
          Для этой занятости не указаны характеристики
        </div>

        <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 class="text-sm font-medium text-green-600 mb-3 flex items-center gap-2">
              <span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span>
              Совпадают ({{ matchedCharacteristics.length }})
            </h3>
            <div v-if="matchedCharacteristics.length === 0" class="text-gray-400 text-sm">
              Нет совпадений
            </div>
            <div v-else class="flex flex-wrap gap-2">
              <span 
                v-for="char in matchedCharacteristics" 
                :key="char.code"
                class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-sm border border-green-200"
              >
                {{ char.name }}
              </span>
            </div>
          </div>

          <div>
            <h3 class="text-sm font-medium text-red-600 mb-3 flex items-center gap-2">
              <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
              Не совпадают ({{ unmatchedCharacteristics.length }})
            </h3>
            <div v-if="unmatchedCharacteristics.length === 0" class="text-gray-400 text-sm">
              Все характеристики совпадают
            </div>
            <div v-else class="flex flex-wrap gap-2">
              <span 
                v-for="char in unmatchedCharacteristics" 
                :key="char.code"
                class="px-3 py-1 bg-red-50 text-red-700 rounded-full text-sm border border-red-200"
              >
                {{ char.name }}
              </span>
            </div>
          </div>
        </div>

        <div v-if="userCharacteristics.length === 0" class="mt-4 text-sm text-gray-500 bg-gray-50 p-3 rounded-lg">
          <i class="fa fa-info-circle mr-2"></i>
          У вас пока не получены характеристики.
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold text-gray-900">Вакансии ({{ employment.vacancies.length }})</h2>
        </div>

        <div v-if="employment.vacancies.length === 0" class="text-center py-8 text-gray-400">
          Для этой занятости пока нет вакансий
        </div>

        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
          <VacancyCard
            v-for="vacancy in employment.vacancies"
            :key="vacancy.id"
            :vacancy="vacancy"
          />
        </div>
      </div>
    </template>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';
import api from '@/js/services/axios';
import { userService } from '@/js/services/user';
import type { User } from '@/js/types/user'
import { Employment } from '@/js/types/employment';

const route = useRoute();
const employmentId = route.params.id as string;

const employment = ref<Employment | null>(null);
const user = ref<User | null>(null);
const loading = ref(true);
const error = ref<string | null>(null);
const favoriteLoading = ref(false);

const userCharacteristics = computed(() => {
  return user.value?.characteristics || [];
});

const userCharacteristicCodes = computed(() => {
  return new Set(userCharacteristics.value.map(c => c.code));
});

const matchedCharacteristics = computed(() => {
  if (!employment.value) return [];
  return employment.value.characteristics.filter(char => 
    userCharacteristicCodes.value.has(char.code)
  );
});

const unmatchedCharacteristics = computed(() => {
  if (!employment.value) return [];
  return employment.value.characteristics.filter(char => 
    !userCharacteristicCodes.value.has(char.code)
  );
});

const formatSalary = (value: number): string => {
  return new Intl.NumberFormat('ru-RU', {
    style: 'currency',
    currency: 'RUB',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(value);
};

const toggleFavorite = async () => {
  if (!employment.value || favoriteLoading.value) return;

  favoriteLoading.value = true;
  try {
    if (employment.value.is_favorite) {
      await api.delete('/favorites/employments', {
        data: { code: employment.value.code }
      });
    } else {
      await api.post('/favorites/employments', {
        code: employment.value.code
      });
    }
    employment.value.is_favorite = !employment.value.is_favorite;
  } catch (err: any) {
    console.error('Favorite toggle error:', err);
    alert('Не удалось изменить статус избранного');
  } finally {
    favoriteLoading.value = false;
  }
};

const fetchData = async () => {
  loading.value = true;
  error.value = null;

  try {
    const [employmentResponse, userProfile] = await Promise.all([
      api.get<Employment>(`/employments/${employmentId}`, {
        params: { interactions: true }
      }),
      userService.getProfile()
    ]);

    employment.value = employmentResponse.data;
    user.value = userProfile;
  } catch (err: any) {
    error.value = err.response?.data?.message || 'Ошибка загрузки данных';
    console.error('Fetch error:', err);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchData();
});
</script>