<template>
  <div class="group relative bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-indigo-100/50 h-full flex flex-col">
    <div class="p-5 flex flex-col gap-3 flex-1">
      <div class="flex items-start justify-between gap-2">
        <router-link :to="route" class="flex-1 min-w-0">
          <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition-colors line-clamp-2 min-h-[3.5rem]">
            {{ employment.name }}
          </h3>
        </router-link>
        <span v-if="employment.metrics.total >= 90" class="text-xs font-medium text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full whitespace-nowrap flex-shrink-0">
          ★ Рекомендуем
        </span>
      </div>

      <div class="flex items-center gap-2 flex-wrap bg-white/60 backdrop-blur-sm rounded-lg px-3 py-2 flex-shrink-0">
        <span class="text-sm text-gray-500">Зарплата:</span>
        <span class="text-base font-bold text-indigo-700">
          {{ formatSalary(employment.salary_from) }} — {{ formatSalary(employment.salary_to) }}
        </span>
      </div>

      <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 flex-1">
        {{ employment.description }}
      </p>

      <div class="flex items-center justify-between pt-2 border-t border-indigo-100/70 mt-auto">
        <div class="flex items-center gap-2">
          <div class="flex items-center gap-1">
            <span class="text-sm text-gray-500">Совпадение</span>
            <span class="text-sm font-semibold text-indigo-600">{{ employment.metrics?.total || 0 }}%</span>
          </div>
        </div>
        <button
          @click.stop="$emit('toggle-favorite', employment.id)"
          class="w-8 h-8 flex items-center justify-center rounded-full bg-white/70 hover:bg-white transition-colors shadow-sm flex-shrink-0"
          :class="{ 'text-red-500': employment.is_favorite, 'text-gray-300': !employment.is_favorite }"
        >
          <i
            class="fa text-base"
            :class="[employment.is_favorite ? 'fa-heart' : 'fa-heart-o']"
            aria-hidden="true"
          ></i>
        </button>
      </div>
    </div>
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
</script>