<template>
  <div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-900 text-center mb-8">
        Интересные вопросы
      </h1>
      <div class="space-y-4">
        <div
          v-for="(item, index) in faqItems"
          :key="index"
          class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden transition-shadow hover:shadow-md"
        >
          <button
            @click="toggleItem(index)"
            class="w-full text-left px-6 py-4 flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <span class="text-lg font-medium text-gray-900">
              {{ item.question }}
            </span>
            <span class="ml-6 flex-shrink-0 text-gray-500">
              <svg
                class="w-5 h-5 transition-transform duration-300"
                :class="{ 'rotate-180': activeIndex === index }"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </span>
          </button>
          <div
            class="faq-content"
            :style="{
              maxHeight: activeIndex === index ? '1000px' : '0px',
              opacity: activeIndex === index ? 1 : 0,
              padding: activeIndex === index ? '0 1.5rem 1.5rem' : '0 1.5rem',
              marginTop: activeIndex === index ? '15px' : '0',
            }"
          >
            <div class="text-gray-700 leading-relaxed">
              {{ item.answer }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { faq } from '@/js/static/faq';
import { ref } from 'vue';

const faqItems = faq;

const activeIndex = ref(null);

const toggleItem = (index) => {
  activeIndex.value = activeIndex.value === index ? null : index;
};
</script>

<style scoped>
.faq-content {
  transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out, padding 0.3s ease-in-out, margin 0.3s ease-in-out;
  overflow: hidden;
  will-change: max-height, opacity, padding;
}
</style>