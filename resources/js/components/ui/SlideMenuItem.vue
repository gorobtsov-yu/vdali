<template lang="">
    <router-link 
	  :to="target"
	  v-if="!href" 
	  class="flex items-center gap-3 px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"
	>
		<slot />
    </router-link>
    <a 
	  :href="href"
	  v-else
	  class="flex items-center gap-3 px-3 py-2 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"
	>
		<slot />
    </a>
</template>
<script setup lang="ts">
interface Props {
	href?: string
	isRouteLink?: boolean
	routeName?: string
	routeParams?: object
}

interface RouteConfig {
	name?: string
	params?: object
}

const props = withDefaults(defineProps<Props>(), {
	href: undefined,
	isRouteLink: true,
	routeName: undefined,
	routeParams: undefined,
})

const target : RouteConfig = {
	name: props.routeName,
	params: props.routeParams,
}
</script>
<style lang="">
    
</style>