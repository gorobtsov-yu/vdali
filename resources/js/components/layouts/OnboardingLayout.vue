<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 flex flex-col">
    <header class="flex-shrink-0 py-4 px-6 border-b border-gray-200 bg-white/80 backdrop-blur-sm">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <span to="/" class="text-xl font-bold text-blue-600">
          {{ appName }}
        </span>
        <div class="flex items-center gap-4 text-sm text-gray-500">
          <span>Шаг {{ step }} из {{ totalSteps }}</span>
          <div class="w-24 h-1.5 bg-gray-200 rounded-full overflow-hidden">
            <div
              class="h-full bg-blue-500 rounded-full transition-all duration-300"
              :style="{ width: `${(step / totalSteps) * 100}%` }"
            >
            </div>
          </div>
        </div>
      </div>
    </header>

    <main class="flex-1 flex items-center justify-center p-4">
      <div class="w-full max-w-3xl top-[-5vh] relative">
        <router-view></router-view>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const appName = import.meta.env.VITE_APP_NAME || 'ВДАЛИ';

const step = computed(() => {
  const name = route.name as string;
  if (name === 'onboarding.test') return 1;
  if (name === 'onboarding.salary') return 2;
  if (name === 'onboarding.tips') return 3;
  return 0;
});

const totalSteps = 3;
</script>