<!-- components/vacancies/VacancyCard.vue -->
<template>
  <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex flex-col gap-3">
    <div class="flex justify-between items-start gap-3">
      <h3 class="text-lg font-semibold text-gray-900 leading-tight">
        {{ vacancy.title }}
      </h3>
    </div>

    <div class="flex items-center gap-2">
      <span class="text-sm text-gray-500">Зарплата:</span>
      <span class="text-base font-semibold text-emerald-600">
        {{ formatSalary(vacancy.salary) }}
      </span>
    </div>

    <p class="text-sm text-gray-600 leading-relaxed">
      {{ truncateText(vacancy.description, 120) }}
    </p>

    <div class="pt-3 border-t border-gray-100 mt-auto">
      <span class="text-xs text-gray-400">{{ vacancy.contact }}</span>
    </div>
  </div>
</template>

<script setup lang="ts">
import { Vacancy } from '@/js/types/vacancy';

defineProps<{
  vacancy: Vacancy;
}>();

const formatSalary = (value: number): string => {
  return new Intl.NumberFormat('ru-RU', {
    style: 'currency',
    currency: 'RUB',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(value);
};

const truncateText = (text: string, limit: number): string => {
  if (text.length <= limit) return text;
  return text.slice(0, limit) + '...';
};
</script>