<template>
  <Teleport to="body">
    <Transition
      enter-active-class="transition-transform duration-300 ease-out"
      leave-active-class="transition-transform duration-300 ease-in"
      enter-from-class="-translate-x-full"
      leave-to-class="-translate-x-full"
    >
      <aside
        v-if="isOpen"
        class="fixed top-0 left-0 bottom-0 my-0 h-[80vh] mt-auto mb-auto bg-white shadow-2xl z-50 flex flex-col overflow-y-auto 
          w-[85vw] sm:w-[60vw] md:w-[40vw] lg:w-[40vw] xl:w-[320px] 2xl:w-[380px] ml-[2vw] rounded-2xl"
      >
        <div class="flex justify-between items-center p-5 border-b border-gray-100 bg-gray-50/80 rounded-tr-2xl">
          <h3 class="text-lg font-semibold text-gray-800">
            <slot name="title">Меню</slot>
          </h3>
          <button
            @click="close"
            class="p-2 rounded-full hover:bg-gray-200 transition-colors text-gray-500 hover:text-gray-700"
          >
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
        </div>
        <div class="flex-1 p-5 overflow-y-auto bg-white">
          <slot />
        </div>
        <div v-if="$slots.footer" class="p-5 border-t border-gray-100 bg-gray-50/80 rounded-br-2xl">
          <slot name="footer" />
        </div>
      </aside>
    </Transition>
  </Teleport>
</template>

<script setup lang="ts">
interface Props {
  isOpen: boolean;
}

defineProps<Props>();

const emit = defineEmits<{
  (e: 'update:isOpen', value: boolean): void;
  (e: 'close'): void;
}>();

const close = () => {
  emit('update:isOpen', false);
  emit('close');
};
</script>