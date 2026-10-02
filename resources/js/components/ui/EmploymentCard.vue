<template>
  <div class="group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col">
    <router-link :to="route" class="block flex-1">
      <!-- Изображение -->
      <div class="relative h-40 bg-gray-100 overflow-hidden">
        <div
            style="width: 400px;
            height: 200px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 flex items-center justify-center"
        >
          <i class="fa fa-text"></i>
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
        <span class="absolute bottom-2 left-3 text-xs text-white/80 font-medium bg-black/30 px-2 py-0.5 rounded-full backdrop-blur-sm">
          {{ employment.code }}
        </span>
      </div>

      <!-- Контент -->
      <div class="p-4 pb-0">
        <h3 class="text-base font-semibold text-gray-800 leading-tight hover:text-blue-600 transition-colors line-clamp-2 min-h-[2.5rem]">
          {{ employment.name }}
        </h3>

        <div class="mt-1 flex items-center gap-1 flex-wrap">
          <span class="text-sm font-medium text-gray-700">
            {{ formatSalary(employment.salary_from) }} — {{ formatSalary(employment.salary_to) }}
          </span>
        </div>

        <p class="mt-2 text-xs text-gray-500 leading-relaxed line-clamp-2">
          {{ truncateText(employment.description, 70) }}
        </p>
      </div>
    </router-link>

    <!-- Метрики -->
    <div class="p-4 pt-2 space-y-2">
      <div class="flex items-center gap-2">
        <span class="text-xs text-gray-400 w-24 flex-shrink-0">Характеристики</span>
        <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
          <div
            class="h-full rounded-full transition-all duration-500"
            :class="metricColor(employment.metrics.characteristics_match_metric)"
            :style="{ width: `${employment.metrics.characteristics_match_metric}%` }"
          />
        </div>
        <span class="text-xs font-medium text-gray-600 w-8 text-right">
          {{ employment.metrics.characteristics_match_metric }}%
        </span>
      </div>
      <div class="flex items-center gap-2">
        <span class="text-xs text-gray-400 w-24 flex-shrink-0">Зарплата</span>
        <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
          <div
            class="h-full rounded-full transition-all duration-500"
            :class="metricColor(employment.metrics.desired_salary_metric)"
            :style="{ width: `${employment.metrics.desired_salary_metric}%` }"
          />
        </div>
        <span class="text-xs font-medium text-gray-600 w-8 text-right">
          {{ employment.metrics.desired_salary_metric }}%
        </span>
      </div>
      <div class="flex justify-between items-center pt-1 border-t border-gray-100 text-xs">
        <span class="text-gray-400">Общая метрика</span>
        <span class="font-semibold text-gray-700">{{ employment.metrics.total }}%</span>
      </div>
    </div>

    <!-- Кнопка избранного -->
    <button
      @click.stop="$emit('toggle-favorite', employment.id)"
      class="absolute top-2 right-2 w-7 h-7 flex items-center justify-center rounded-full bg-white/70 backdrop-blur-sm hover:bg-white transition-colors shadow-sm"
    >
      <i
        class="fa text-sm"
        :class="[employment.is_favorite ? 'fa-heart text-red-500' : 'fa-heart-o text-gray-300']"
        aria-hidden="true"
      ></i>
    </button>
  </div>
</template>

<script setup lang="ts">
import { IndexEmployment } from '@/js/types/employment';

const props = defineProps<{
  employment: IndexEmployment;
}>();

const emit = defineEmits<{
  (e: 'toggle-favorite', id: number): void;
}>();

const route = {
  name: 'app.employment',
  params: {
    id: props.employment.id
  }
};

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

const metricColor = (value: number): string => {
  if (value >= 80) return 'bg-blue-500';
  if (value >= 50) return 'bg-blue-300';
  return 'bg-gray-300';
};
</script>