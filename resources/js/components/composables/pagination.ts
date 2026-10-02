import { ref, computed, readonly } from 'vue';
import api from '@/js/services/axios';

interface UsePaginationOptions {
  initialUrl?: string;
  autoFetch?: boolean;
  onSuccess?: (data: any[]) => void;
  onError?: (error: Error) => void;
  params?: Record<string, any>;
}

interface Link<T> {
  url: string;
  label: string;
  page: number;
  active: boolean;
}

interface PaginationResponse<T> {
  data: T[];
  links: {
    next: string;
    prev: string;
  };
  meta: {
    total: number;
    links: Link<T>[];
  };
}

export function usePagination<T = any>(options: UsePaginationOptions = {}) {
  const items = ref<T[]>([]);
  const currentUrl = ref<string | null>(options.initialUrl || null);
  const nextUrl = ref<string | null>(null);
  const prevUrl = ref<string | null>(null);
  const loading = ref(false);
  const error = ref<string | null>(null);
  const total = ref<number | null>(null);
  const baseParams = ref<Record<string, any>>(options.params || {});

  const hasNext = computed(() => !!nextUrl.value);
  const hasPrevious = computed(() => !!prevUrl.value);

  const buildUrlWithParams = (url: string, params?: Record<string, any>): string => {
    if (!params || Object.keys(params).length === 0) {
      return url;
    }
  
    const separator = url.includes('?') ? '&' : '?';
    const queryParams = Object.entries(params)
      .filter(([_, value]) => value !== undefined && value !== null && value !== '')
      .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(String(value))}`)
      .join('&');

    if (!queryParams) {
      return url;
    }

    return `${url}${separator}${queryParams}`;
  };

  const fetchPage = async (url: string, additionalParams?: Record<string, any>) => {
    if (!url) return;

    loading.value = true;
    error.value = null;

    try {
      const mergedParams = { ...baseParams.value, ...additionalParams };
      const finalUrl = buildUrlWithParams(url, mergedParams);

      const response = await api.get(finalUrl);
      const data: PaginationResponse<T> = response.data;

      items.value = data.data;
      nextUrl.value = data.links.next || null;
      prevUrl.value = data.links.prev || null;
      currentUrl.value = url;
      total.value = data.meta.total || null;

      options.onSuccess?.(data.data);
    } catch (err) {
      const message = err instanceof Error ? err.message : 'Unknown error';
      error.value = message;
      options.onError?.(err as Error);
    } finally {
      loading.value = false;
    }
  };

  const nextPage = async () => {
    if (nextUrl.value && !loading.value) {
      await fetchPage(nextUrl.value);
    }
  };

  const previousPage = async () => {
    if (prevUrl.value && !loading.value) {
      await fetchPage(prevUrl.value);
    }
  };

  const refresh = async (params?: Record<string, any>) => {
    if (currentUrl.value) {
      await fetchPage(currentUrl.value, params);
    }
  };

  const reset = () => {
    items.value = [];
    nextUrl.value = null;
    prevUrl.value = null;
    error.value = null;
    total.value = null;

    if (options.initialUrl) {
      fetchPage(options.initialUrl);
    }
  };

  const updateParams = (params: Record<string, any>) => {
    baseParams.value = { ...baseParams.value, ...params };
    if (currentUrl.value) {
      fetchPage(currentUrl.value);
    }
  };

  if (options.autoFetch !== false && options.initialUrl) {
    fetchPage(options.initialUrl, options.params);
  }

  return {
    items: readonly(items),
    loading: readonly(loading),
    error: readonly(error),
    hasNext,
    hasPrevious,
    total: readonly(total),
    nextPage,
    previousPage,
    refresh,
    fetchPage,
    reset,
    updateParams,
    currentUrl: readonly(currentUrl),
  };
}