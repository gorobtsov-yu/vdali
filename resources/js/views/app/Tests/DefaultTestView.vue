<template>
  <div class="max-w-3xl mx-auto px-4 py-8">
    <div v-if="loading" class="flex justify-center items-center min-h-[300px]">
      <div class="w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
    </div>

    <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
      <p class="text-red-600">{{ error }}</p>
      <button
        @click="loadTest"
        class="mt-4 px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
      >
        Повторить
      </button>
    </div>

    <div v-else-if="result">
      <div class="bg-white rounded-2xl shadow-xl p-8 text-center animate-fadeIn">
        <div class="text-6xl mb-4">🎉</div>
        <h2 class="text-2xl font-bold text-gray-800">Результат теста</h2>
        <p class="mt-2 text-lg text-gray-600">{{ result }}</p>
        <button
          @click="$router.push({ name: 'app.tests' })"
          class="mt-6 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
        >
          К списку тестов
        </button>
      </div>
    </div>

    <div v-else-if="test">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ test.name }}</h1>
        <p v-if="test.description" class="text-gray-500 mt-1">{{ test.description }}</p>
        <div class="mt-2 flex items-center gap-2 text-sm text-gray-500">
          <span>Вопрос {{ currentIndex + 1 }} из {{ test.questions.length }}</span>
          <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
            <div
              class="h-full bg-blue-500 rounded-full transition-all duration-300"
              :style="{ width: `${((currentIndex + 1) / test.questions.length) * 100}%` }"
            />
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div v-if="currentQuestion" class="space-y-4">
          <h3 class="text-lg font-medium text-gray-800">
            {{ currentQuestion.text }}
          </h3>

          <div class="space-y-2">
            <label
              v-for="answer in currentQuestion.answers"
              :key="answer.id"
              class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition-colors"
              :class="{ 'border-blue-400 bg-blue-50': selectedAnswer === answer.id }"
            >
              <input
                type="radio"
                :name="`question-${currentQuestion.id}`"
                :value="answer.id"
                v-model="selectedAnswer"
                class="w-4 h-4 text-blue-500 focus:ring-blue-400"
              />
              <span class="text-gray-700">{{ answer.text }}</span>
            </label>
          </div>
        </div>
      </div>

      <div class="flex justify-between">
        <button
          v-if="currentIndex > 0"
          @click="prevQuestion"
          class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
        >
          Назад
        </button>
        <button
          v-else
          class="px-6 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed"
          disabled
        >
          Назад
        </button>

        <button
          v-if="currentIndex < test.questions.length - 1"
          @click="nextQuestion"
          :disabled="!selectedAnswer"
          class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Далее →
        </button>
        <button
          v-else
          @click="submitTest"
          :disabled="!selectedAnswer || submitting"
          class="px-8 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
        >
          <span v-if="!submitting">Отправить</span>
          <span v-else class="flex items-center gap-2">
            <span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
            Отправка...
          </span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '@/js/services/axios';
import { Test } from '@/js/types/test';

const route = useRoute();
const router = useRouter();
const code = route.params.code as string;

const test = ref<Test | null>(null);
const loading = ref(false);
const error = ref<string | null>(null);
const currentIndex = ref(0);
const answers = ref<Record<number, number>>({}); // questionId -> answerId
const submitting = ref(false);
const result = ref<string | null>(null);

const currentQuestion = computed(() => test.value?.questions[currentIndex.value] || null);
const selectedAnswer = computed({
  get: () => {
    if (!currentQuestion.value) return null;
    return answers.value[currentQuestion.value.id] || null;
  },
  set: (val: number | null) => {
    if (!currentQuestion.value) return;
    if (val !== null) {
      answers.value[currentQuestion.value.id] = val;
    } else {
      delete answers.value[currentQuestion.value.id];
    }
  }
});

const loadTest = async () => {
  loading.value = true;
  error.value = null;
  try {
    const response = await api.get<Test>(`/tests/${code}`);
    test.value = response.data;
  } catch (err: any) {
    error.value = err.response?.data?.message || 'Не удалось загрузить тест';
  } finally {
    loading.value = false;
  }
};

const nextQuestion = () => {
  if (!test.value) return;
  if (currentIndex.value < test.value.questions.length - 1) {
    currentIndex.value++;
  }
};

const prevQuestion = () => {
  if (currentIndex.value > 0) {
    currentIndex.value--;
  }
};

const submitTest = async () => {
  if (!test.value || submitting.value) return;
  submitting.value = true;
  try {
    const payload = {
      test_id: test.value.id,
      answers: answers.value,
    };
    console.log(payload)
    const response = await api.post(`/tests/${code}/submit`, payload);
    result.value = response.data.name;
  } catch (err: any) {
    alert('Ошибка при отправке ответов');
    console.error(err);
  } finally {
    submitting.value = false;
  }
};

onMounted(() => {
  loadTest();
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
</style>