import type { Component } from 'vue';
import { OPEN_TEST_CODE } from './data/open';
import { ASSOCIATIVE_TEST_CODE } from './data/associative';

export const testComponentRegistry: Record<string, () => Promise<Component>> = {
  [OPEN_TEST_CODE]: () => import('@/js/views/app/Tests/OpenTestView.vue'),
  [ASSOCIATIVE_TEST_CODE]: () => import('@/js/views/app/Tests/AssociativeTestView.vue'),
  default: () => import('@/js/views/app/Tests/DefaultTestView.vue'),
};

export const getComponentForTest = async (code: string): Promise<Component> => {
  console.log(code);
  console.log(testComponentRegistry[code]);
  const loader = testComponentRegistry[code] || testComponentRegistry.default;
  return await loader();
};