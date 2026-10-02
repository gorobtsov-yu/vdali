<template>
  <div class="relative w-full">
    <div
      class="grid"
      :class="gridClasses"
      :style="{
        gap: `${gap}px`,
        '--min-width': `${minWidth}px`,
      }"
    >
      <slot :items="pagination.items.value" />
    </div>

    <div
      v-if="paginated && (pagination.hasNext.value || pagination.hasPrevious.value)"
      class="flex items-center justify-center gap-4 mt-8 p-4"
    >
      <button
        @click="pagination.previousPage()"
        :disabled="pagination.loading.value || !pagination.hasPrevious.value"
        class="px-4 py-2 bg-gray-200 rounded-md cursor-pointer transition-all duration-200 text-gray-700 text-xl flex items-center justify-center hover:bg-gray-300 hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed"
      >
        <i class="fa fa-angle-left" aria-hidden="true"></i>
      </button>

      <span class="text-sm text-gray-500">
        {{ pagination.loading.value ? 'Загрузка...' : '' }}
      </span>

      <button
        @click="pagination.nextPage()"
        :disabled="pagination.loading.value || !pagination.hasNext.value"
        class="px-4 py-2 bg-gray-200 rounded-md cursor-pointer transition-all duration-200 text-gray-700 text-xl flex items-center justify-center hover:bg-gray-300 hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed"
      >
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </button>
    </div>

    <div
      v-if="pagination.loading.value && paginated"
      class="absolute inset-0 bg-white/80 flex items-center justify-center z-10"
    >
      <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"></div>
    </div>

    <div
      v-if="pagination.error.value && paginated"
      class="text-center p-4 text-red-500 bg-red-50 rounded-lg mt-4"
    >
      {{ pagination.error.value }}
      <button @click="pagination.refresh()" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded cursor-pointer hover:bg-blue-600 transition">
        Повторить
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, watch } from 'vue';
import { usePagination } from '@/js/components/composables/pagination';

interface Props {
  cols?: {
    mobile?: number;
    tablet?: number;
    desktop?: number;
    large?: number;
  };
  centered?: boolean;
  minWidth?: number;
  gap?: number;
  paginated?: boolean;
  url?: string;
  params?: Record<string, any>;
}

const props = withDefaults(defineProps<Props>(), {
  cols: () => ({ mobile: 1, tablet: 2, desktop: 3, large: 4 }),
  centered: false,
  minWidth: 200,
  gap: 20,
  paginated: false,
  url: '',
  params: () => ({}),
});

const emit = defineEmits<{
  'update:data': [data: any[]];
  'page-change': [page: { next: string | null; previous: string | null }];
}>();

const pagination = usePagination({
  initialUrl: props.url,
  autoFetch: props.paginated && !!props.url,
  params: props.params,
  onSuccess: (data) => emit('update:data', data),
});

const gridClasses = computed(() => {
  const { mobile, tablet, desktop, large } = props.cols;
  const cols = [
    `grid-cols-${mobile || 1}`,
    `sm:grid-cols-${tablet || 2}`,
    `md:grid-cols-${desktop || 3}`,
    `lg:grid-cols-${large || 4}`,
  ];

  const rows = 'auto-rows-[1fr]';
  const stretch = '[&>*]:w-full [&>*]:h-full';
  const center = props.centered ? 'justify-items-center justify-center' : '';
  const minWidthClass = '[&>*]:min-w-[var(--min-width)]';

  return [rows, stretch, minWidthClass, ...cols, center].filter(Boolean).join(' ');
});

watch(() => props.url, (newUrl) => {
  if (newUrl && props.paginated) {
    pagination.fetchPage(newUrl, props.params);
  }
});

watch(() => props.params, (newParams) => {
  if (props.paginated && props.url) {
    pagination.updateParams(newParams);
  }
}, { deep: true });

defineExpose({
  reset: pagination.reset,
  refresh: pagination.refresh,
  updateParams: pagination.updateParams,
  pagination,
});
</script>