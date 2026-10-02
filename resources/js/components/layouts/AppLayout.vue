<template lang="">
	<div class="min-h-screen max-w-screen bg-gray-100 overflow-hidden">
		<div class="w-full flex items-center p-5 h-[40px] pt-7 pb-7 rounded-br-lg rounded-bl-lg bg-gray-300">
			<button 
			  @click="menuOpen = true"
			  v-show="!menuOpen"
			>
			  	<i class="fa fa-bars fa-2x" aria-hidden="true"></i>
			</button>
			<img :src="logo" alt="ВДАЛИ" class="absolute m-auto h-[35px] right-5">
		</div>
		<div class="flex flex-row w-full overflow-hidden pt-10 pb-10">
			<SlideMenu v-model:is-open="menuOpen">
				<template #title>
					<div class="flex items-center gap-2">
						<span>Навигация</span>
					</div>
				</template>
				<nav class="space-y-1">
					<SlideMenuItem v-if="userStore.user.panel_access" href="/app/admin">
						<i class="fa fa-desktop" aria-hidden="true"></i>
					  	Панель управления
					</SlideMenuItem>
					<SlideMenuItem routeName="app.progress">
						<i class="fa fa-home" aria-hidden="true"></i>
					  	Прогресс
					</SlideMenuItem>
					<SlideMenuItem routeName="app.profile">
						<i class="fa fa-user-circle" aria-hidden="true"></i>
					  	Профиль
					</SlideMenuItem>
					<SlideMenuItem routeName="app.employments">
						<i class="fa fa-id-card" aria-hidden="true"></i>
					  	Занятости
					</SlideMenuItem>
					<SlideMenuItem routeName="app.tests">
						<i class="fa fa-book" aria-hidden="true"></i>
						Тесты
					</SlideMenuItem>
					<SlideMenuItem routeName="app.vacancies">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						Вакансии
					</SlideMenuItem>
					<SlideMenuItem routeName="app.faq">
						<i class="fa fa-question-circle-o" aria-hidden="true"></i>
					  	Вопрос - Ответ
					</SlideMenuItem>
				</nav>
				<template #footer>
					<button 
					  @click="handleLogout"
					  class="flex items-center gap-3 px-3 py-2 w-full text-red-600 rounded-lg hover:bg-gray-200 transition-colors"
					>
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						Выйти
					</button>
				</template>
			</SlideMenu>
			<div
				id="app-content"
				:class="
					menuOpen ? 'xl:ml-[380px] lg:ml-[40vw] md:ml-[60vw] pl-[60px] w-full' : 'w-full'
				"
			>
				<div class="pl-10 pr-10">
					<router-view></router-view>
				</div>
			</div>
		</div>
  	</div>
</template>
<script setup lang="ts">
import { ref } from 'vue'
import router from '@/js/router'
import logo from '@/images/logo/logo-no-text.png'
import { useAuthStore } from '@/js/stores/auth'
import { useUserStore } from '@/js/stores/user'

const menuOpen = ref(false)

const authStore = useAuthStore()
const userStore = useUserStore()

const handleLogout = async () => {
  	menuOpen.value = false
  	const r = await authStore.logout()

	if (r) {
		router.push('/')
	}
}
</script>
<style scoped>
#app-content {
	transition: all 0.3s ease;
}
</style>