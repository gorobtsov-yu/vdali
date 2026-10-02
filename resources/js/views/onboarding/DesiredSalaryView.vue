<!-- views/onboarding/SalaryView.vue -->
<template>
  <div class="max-w-md mx-auto px-4 py-8 flex flex-col items-center min-h-[80vh] justify-center">
    <div class="w-full bg-white rounded-2xl shadow-lg p-6">
      <h1 class="text-2xl font-bold text-gray-800 text-center">Желаемая зарплата</h1>
      <p class="text-gray-500 text-center mt-2">Укажите ваши ожидания по заработной плате, чтобы мы могли подбирать более точные предложения.</p>

      <form @submit.prevent="submitSalary" class="mt-6 space-y-4">
        <div>
          <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Желаемая зарплата (₽)</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">₽</span>
            <input
              id="salary"
              v-model.number="formData.desiredSalary"
              type="number"
              min="0"
              placeholder="50000"
              class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
              :disabled="isSubmitting"
            />
          </div>
          <p v-if="errors.desiredSalary" class="mt-1 text-sm text-red-500">{{ errors.desiredSalary }}</p>
        </div>

        <button
          type="submit"
          :disabled="isSubmitting || !formData.desiredSalary || formData.desiredSalary <= 0"
          class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
        >
          <span v-if="!isSubmitting">Сохранить и продолжить</span>
          <span v-else class="flex items-center gap-2">
            <span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
            Сохранение...
          </span>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/js/stores/user';
import { useForm } from '@/js/components/composables/form';

const router = useRouter();
const userStore = useUserStore();

const validationRules = {
  desiredSalary: {
    required: true,
    min: 100,
    max: 10000000,
    message: 'Некорректный желаемый доход'
  }
}

const {
  formData,
  errors,
  isSubmitting,
  validateForm,
} = useForm(
  {
    desiredSalary: 50000,
  },
  validationRules,
)

const submitSalary = async () => {
  if (!validateForm()) {
    return;
  }
  try {
    await userStore.updateProfile({ desired_salary: formData.desiredSalary });
    router.push({ name: 'onboarding.tips' });
  } catch (err: any) {
    console.log(err);
  }
};
</script>