<template>
  <router-link :to="route" class="block h-full">
    <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex flex-col h-full gap-3">
      <div class="flex justify-between items-start gap-3">
        <h3 class="text-lg font-semibold text-gray-900 leading-tight line-clamp-2 min-h-[3.5rem]">
          {{ test.name }}
        </h3>
        <span class="text-xs text-gray-400 font-mono bg-gray-100 px-2 py-1 rounded whitespace-nowrap flex-shrink-0">
          ~ 5 мин.
        </span>
      </div>

      <p class="text-sm text-gray-500 leading-relaxed flex-1 line-clamp-3">
        {{ test.description || '...' }}
      </p>

      <div class="pt-3 border-t border-gray-100 flex justify-end mt-auto">
        <span class="text-sm text-blue-500 hover:text-blue-600 font-medium transition-colors flex items-center gap-1">
          Пройти
          <i class="fa fa-arrow-right text-xs"></i>
        </span>
      </div>
    </div>
  </router-link>
</template>

<script setup lang="ts">
import { IndexTest } from '@/js/types/test';

const props = defineProps<{
  test: IndexTest;
}>();

const route = {
  name: 'app.test',
  params: {
    code: props.test.code
  }
};
</script>