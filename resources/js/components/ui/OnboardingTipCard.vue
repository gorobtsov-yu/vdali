<template>
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full">
    <div class="relative h-48 bg-gray-100">
      <img
        :src="imageUrl"
        :alt="title"
        class="w-full h-full object-cover"
        loading="lazy"
      />
      <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
    </div>
    <div class="p-6 flex flex-col flex-1">
      <h3 class="text-xl font-bold text-gray-800">{{ title }}</h3>
      <p class="mt-2 text-gray-600 leading-relaxed flex-1">{{ description }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  title: string;
  description: string;
  imageUrl: string;
}>();
</script>