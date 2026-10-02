<template>
  <div class="associative-test min-h-max py-8 px-4 flex items-center justify-center">
    <div class="w-full max-w-2xl mx-auto">
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Оцените занятости</h1>
        <p class="text-gray-500 mt-2">Нажимайте кнопки, чтобы выбрать подходящие варианты</p>
      </div>

      <div v-if="loading" class="flex flex-col items-center justify-center min-h-[400px]">
        <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
        <p class="mt-4 text-gray-500">Загрузка занятостей...</p>
      </div>

      <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
        <p class="text-red-600">{{ error }}</p>
        <button @click="fetchEmployments" class="mt-4 px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
          Повторить
        </button>
      </div>

      <div v-else-if="currentIndex >= employments.length && !isSubmitting && !result" class="bg-white rounded-2xl shadow-xl p-8 text-center">
        <div class="text-6xl mb-4">🎉</div>
        <h2 class="text-2xl font-bold text-gray-800">Вы оценили все варианты!</h2>
        <p class="text-gray-500 mt-2">Нажмите кнопку, чтобы получить результат</p>
        <button @click="submitResults" class="mt-6 px-8 py-3 bg-gradient-to-r from-green-400 to-emerald-500 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 mx-auto">
          <span v-if="!isSubmitting">Получить результат</span>
          <span v-else class="flex items-center gap-2">
            <span class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
            Обработка...
          </span>
        </button>
      </div>
  
      <div v-else-if="result" class="bg-white rounded-2xl shadow-xl p-8 text-center animate-fadeIn">
        <div class="text-6xl mb-4">📊</div>
        <h2 class="text-2xl font-bold text-gray-800">Результат</h2>
        <div class="mt-4 p-4 bg-gray-50 rounded-xl text-gray-700 whitespace-pre-wrap leading-relaxed">
          {{ result }}
        </div>
        <button v-if="!isOnboarding" @click="resetTest" class="mt-6 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
          Пройти ещё
        </button>
        <button v-else @click="emit('completed')" class="mt-6 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
          Продолжить
        </button>
      </div>

      <div v-else class="relative">
        <div class="flex justify-between items-center mb-4 text-sm text-gray-500">
          <span>{{ currentIndex + 1 }} из {{ employments.length }}</span>
          <div class="flex-1 mx-4 h-2 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-blue-500 rounded-full transition-all duration-300" :style="{ width: `${((currentIndex + 1) / employments.length) * 100}%` }"></div>
          </div>
          <span>{{ Math.round(((currentIndex + 1) / employments.length) * 100) }}%</span>
        </div>

        <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 hover:shadow-3xl">
          <div class="relative h-48 bg-gray-200">
            <img
              :src="`https://picsum.photos/seed/${currentEmployment.id}/800/400`"
              :alt="currentEmployment.name"
              class="w-full h-full object-cover"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            <span class="absolute bottom-3 left-4 text-white text-sm font-medium bg-black/30 px-3 py-1 rounded-full backdrop-blur-sm">
              {{ currentEmployment.code }}
            </span>
          </div>

          <div class="p-4 sm:p-6">
            <h3 class="text-xl font-bold text-gray-900">{{ currentEmployment.name }}</h3>

            <div class="mt-2 flex items-center gap-2 flex-wrap">
              <span class="text-sm text-gray-500">Зарплата:</span>
              <span class="text-lg font-semibold text-emerald-600">
                {{ formatSalary(currentEmployment.salary_from) }} — {{ formatSalary(currentEmployment.salary_to) }}
              </span>
            </div>

            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
              {{ currentEmployment.description || 'Описание отсутствует' }}
            </p>
          </div>

          <div class="flex divide-x divide-gray-100 border-t border-gray-100">
            <button
              @click="dislike"
              class="flex-1 py-4 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center gap-2 font-medium"
            >
              <i class="fa fa-times text-2xl"></i>
              <span class="hidden sm:inline">Не нравится</span>
            </button>
            <button
              @click="like"
              class="flex-1 py-4 text-green-500 hover:bg-green-50 transition-colors flex items-center justify-center gap-2 font-medium"
            >
              <i class="fa fa-heart text-2xl"></i>
              <span class="hidden sm:inline">Нравится</span>
            </button>
          </div>
        </div>

        <p class="text-center text-xs text-gray-400 mt-4 sm:hidden">
          Нажмите на кнопку, чтобы оценить
        </p>
      </div>

      <div v-if="!isOnboarding" class="w-full p-5 font-bold text-center text-gray-400">
        <router-link :to="{ name: 'app.tests' }" >
          <i class="fa fa-times"></i>
          Выйти
        </router-link>
      </div>

      <div v-if="isSubmitting" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full text-center shadow-2xl">
          <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
          <h3 class="text-xl font-bold text-gray-800 mt-4">Обработка результатов</h3>
          <p class="text-gray-500 mt-2">Нейросеть анализирует ваши предпочтения</p>
          <div class="mt-4 flex justify-center items-center gap-1">
            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></span>
            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
          </div>
          <p class="text-sm text-gray-400 mt-4">Это может занять несколько секунд</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import api from '@/js/services/axios';
import { IndexEmployment } from '@/js/types/employment';

interface Props {
  isOnboarding?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  isOnboarding: false,
});

const emit = defineEmits<{
  (e: 'completed'): void;
}>();

const employments = ref<IndexEmployment[]>([]);
const currentIndex = ref(0);
const results = ref<Record<string, boolean>>({});
const loading = ref(false);
const error = ref<string | null>(null);
const isSubmitting = ref(false);
const result = ref<string | null>(null);

const currentEmployment = computed(() => employments.value[currentIndex.value]);

const formatSalary = (value: number): string => {
  return new Intl.NumberFormat('ru-RU', {
    style: 'currency',
    currency: 'RUB',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(value);
};

const fetchEmployments = async () => {
  loading.value = true;
  error.value = null;
  try {
    const response = await api.get('/tests/associative', {
      params: {
        limit: 10,
      }
    });
    employments.value = response.data;
  } catch (err: any) {
    error.value = err.response?.data?.message || 'Ошибка загрузки занятостей';
  } finally {
    loading.value = false;
  }
};

const like = () => {
  if (!currentEmployment.value) return;
  results.value[currentEmployment.value.code] = true;
  nextEmployment();
};

const dislike = () => {
  if (!currentEmployment.value) return;
  results.value[currentEmployment.value.code] = false;
  nextEmployment();
};

const nextEmployment = () => {
  currentIndex.value++;
};

const submitResults = async () => {
  isSubmitting.value = true;
  try {
    const response = await api.post('/tests/associative/submit', results.value);
    result.value = response.data.result;
  } catch (err: any) {
    alert('Ошибка при получении результата');
    console.error(err);
  } finally {
    isSubmitting.value = false;
  }
};

const resetTest = () => {
  result.value = null;
  currentIndex.value = 0;
  results.value = {};
  fetchEmployments();
};

onMounted(() => {
  fetchEmployments();
});
</script>

<style scoped>
.animate-fadeIn {
  animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-bounce {
  animation: bounce 0.8s infinite ease-in-out;
}

@keyframes bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-8px);
  }
}
</style>