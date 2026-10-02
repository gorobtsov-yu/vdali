import type { Router } from 'vue-router';
import { useAuthStore } from '@/js/stores/auth';
import { useUserStore } from '../stores/user';

export function setupGuards(router: Router) {
  router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();
    const userStore = useUserStore();

    if (!authStore.isChecked) {
      await authStore.checkAuth();
    }

    const requiresAuth = to.matched.some(route => route.meta?.requiresAuth === true);
    const guestOnly = to.matched.some(route => route.meta?.guestOnly === true);
    const skipOnboarding = to.matched.some(route => route.meta?.skipOnboardingCheck === true);

    if (!requiresAuth) {
      return next();
    }

    if (!authStore.isAuthenticated) {
      return next({
        name: 'guest.welcome',
      });
    }

    if (guestOnly && authStore.isAuthenticated) {
      return next({ name: 'app.progress' });
    }

    if (!userStore.isLoaded) {
      await userStore.fetchProfile();
    }

    if (!skipOnboarding && !userStore.hasCharacteristics && !userStore.onboardingCompleted) {
      return next({
        name: 'onboarding.test',
      });
    }

    next();
  });
}