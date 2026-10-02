<template>
    <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 sm:mb-8 md:mb-10 animate-fade-up">
        ВДАЛИ
    </div>
    <div class="flex w-[90%] justify-center items-center flex-col gap-6 sm:gap-8 md:gap-10">
        <div class="w-[80%] sm:w-[50%] md:w-[30%] text-center text-sm sm:text-base md:text-lg lg:text-xl animate-fade-up animate-delay-1">
            Проект, который свяжет осознанную профориентацию с качественным результатом
        </div>
        <model-viewer 
            class="w-[70%] sm:w-[90%] md:w-[70%] lg:w-[30%] h-[40vh] animate-fade-up animate-delay-2"
            alt="House" 
            :src="cubes" 
            ar
            loading="eager"
            shadow-intensity="4" 
            camera-orbit="20rad 1.0rad 1rad"
            camera-target="0m -0.5m 0m"
        >
            <template v-slot:progress-bar>
                <div style="display: none;"></div>
            </template>
        </model-viewer>
    </div>
</template>

<script setup lang="ts">
import cubes from '@/models/cubes.glb';
</script>

<style scoped>
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-up {
    animation: fadeUp 0.8s ease-out forwards;
    opacity: 0;
}

.animate-delay-1 {
    animation-delay: 0.2s;
}

.animate-delay-2 {
    animation-delay: 0.4s;
}
</style>