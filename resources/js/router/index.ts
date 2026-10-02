import { createRouter, createWebHistory } from 'vue-router';
import { routes } from './routes';
import { setupAuthGuards } from './auth.guards';

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { top: 0 };
        }
    }
});

setupAuthGuards(router);

router.beforeEach((to, from, next) => {
    const title = to.meta?.title as string;
    if (title) {
        document.title = `${title} | ВДАЛИ`;
    }
    next();
});

export default router;