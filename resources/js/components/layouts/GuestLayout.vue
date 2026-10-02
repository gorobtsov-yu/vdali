<template>
    <!-- Убрал w-screen → w-full, убрал h-full (min-h-screen достаточно) -->
    <div class="min-h-screen w-full bg-gray-100 flex items-center flex-col overflow-x-hidden">
        
        <!-- w-[90vw] заменил на w-full max-w-6xl mx-auto, 
             m-15 заменил на mt-5 mb-5 (он всё равно перекрывался mt-5) -->
        <div class="bg-white px-6 py-5 h-20 w-full max-w-6xl flex justify-between items-center rounded-4xl mt-5 mb-5 z-100">
            <img class="w-[60px]" :src="logo" alt="logo">
            <ButtonBase variant="primary" @click="openModal">
                Войти
            </ButtonBase>
        </div>
        
        <router-view class="w-full"></router-view>
        
        <FormModal 
            v-model:is-open="isModalOpen" 
            :isTransparent="true"
            @close="handleModalClose"
        >
            <FormLogin @submit="handleLogin" />
        </FormModal>
    </div>
</template>

<script setup lang="ts">  
import logo from '@/images/logo/logo-no-text.png';
import { ref } from 'vue'
import { useAuthStore } from '@/js/stores/auth';
import router from '@/js/router';

const auth = useAuthStore();

const isModalOpen = ref(false)

const openModal = () => {
    isModalOpen.value = true
}

const handleLogin = async (data: {login: string, password: string}) => {
    const r = await auth.login(data.login, data.password)

    if (r.success) {
        router.push({ name: 'app.progress' })
    } else {
        console.log(r.error)
    }
}
</script>