import type { Router, RouteLocationNormalized } from 'vue-router';
import { useAuthStore } from '@/js/stores/auth';


function getMetaFields(to: RouteLocationNormalized): { requiresAuth: boolean; guestOnly: boolean } {
    let requiresAuth = false;
    let guestOnly = false;
    
    for (const route of to.matched) {
        if (route.meta?.requiresAuth === true) {
            requiresAuth = true;
        }
        if (route.meta?.guestOnly === true) {
            guestOnly = true;
        }
    }
    
    return { requiresAuth, guestOnly };
}

export function setupAuthGuards(router: Router) {
    router.beforeEach(async (to, from, next) => {
        
        const authStore = useAuthStore();
        
        const { requiresAuth, guestOnly } = getMetaFields(to);
        
        const allowedGuestRedirects = ['guest.welcome'];
        const allowedAuthRedirects = ['app.progress'];
        
        if (!authStore.isChecked) {
            await authStore.checkAuth();
        }
        
        if (requiresAuth && !authStore.isAuthenticated) {
            if (allowedGuestRedirects.includes(to.name as string)) {
                return next();
            }
            
            return next({ name: 'guest.welcome' });
        } 
        
        if (guestOnly && authStore.isAuthenticated) {
            if (allowedAuthRedirects.includes(to.name as string)) {
                return next();
            }
            
            return next({ name: 'app.progress' }); 
        } 
        
        return next();
    });
}