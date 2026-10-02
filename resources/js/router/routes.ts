import { RouteRecordRaw } from 'vue-router';
import VacanciesView from '../views/app/Vacancies/VacanciesView.vue';
import NotFound from '../views/errors/NotFound.vue';

// Layouts
const GuestLayout = () => import('@/js/components/layouts/GuestLayout.vue');
const AppLayout = () => import('@/js/components/layouts/AppLayout.vue');
const OnboardingLyaout = () => import('@/js/components/layouts/OnboardingLayout.vue');

// Guest
const WelcomeView = () => import('@/js/views/guest/WelcomeView.vue');

// App
const ProgressView = () => import('@/js/views/app/ProgressView.vue');
const ProfileView = () => import('@/js/views/app/ProfileView.vue');
const TestsView = () => import('@/js/views/app/Tests/TestsView.vue');
const EmploymentsView = () => import('@/js/views/app/Employments/EmploymentsView.vue');
const EmploymentView = () => import('@/js/views/app/Employments/EmploymentView.vue');
const EmploymentsFavoritesView = () => import('@/js/views/app/Employments/FavoritesView.vue');
const EmploymentsHistoryView = () => import('@/js/views/app/Employments/HistoryView.vue');
const TestView = () => import('@/js/views/app/Tests/TestView.vue');
const FaqView = () =>  import('@/js/views/app/FaqView.vue');
const InfoView = () => import('@/js/views/guest/InfoView.vue');

// Onboarding
const OnboardingTestView = () => import('@/js/views/onboarding/TestView.vue');
const OnboardingTipsView = () => import('@/js/views/onboarding/TipsView.vue');
const OnboardingDesiredSalaryView = () => import('@/js/views/onboarding/DesiredSalaryView.vue');

export const routes: RouteRecordRaw[] = [
    {
        path: '/',
        component: GuestLayout,
        children: [
            {
                path: '/',
                name: 'guest.welcome',
                component: WelcomeView,
                meta: {
                    title: 'Главная',
                },
            },
            {
                path: '/info',
                name: 'guest.info',
                component: InfoView,
                meta: {
                    title: 'Информация',
                },
            },
        ],
        meta: {
            guestOnly: true,
        }
    },
    {
        path: '/onboarding',
        component: OnboardingLyaout,
        children: [
            {
              path: 'test',
              name: 'onboarding.test',
              component: OnboardingTestView,
              meta: { title: 'Тест' },
            },
            {
              path: 'salary',
              name: 'onboarding.salary',
              component: OnboardingDesiredSalaryView,
              meta: { title: 'Желаемая зарплата' },
            },
            {
              path: 'tips',
              name: 'onboarding.tips',
              component: OnboardingTipsView,
              meta: { title: 'Советы' },
            },
        ],
        meta: {
            requiresAuth: true,
            skipOnboardingCheck: true,
        }
    },
    {
        path: '/app',
        component: AppLayout,
        children: [
            { 
                path: '', 
                redirect: { name: 'app.progress' }
            },
            {
                path: 'progress',
                name: 'app.progress',
                component: ProgressView,
                meta: {
                    title: 'Прогресс',
                },
            },
            {
                path: 'employments',
                children: [
                    {
                        path: '',
                        name: 'app.employments',
                        component: EmploymentsView,
                        meta: {
                            title: 'Занятости',
                        }
                    },
                    {
                      path: 'favorites',
                      name: 'app.employments.favorites',
                      component: EmploymentsFavoritesView,
                      meta: { title: 'Избранное' },
                    },
                    {
                      path: 'history',
                      name: 'app.employments.history',
                      component: EmploymentsHistoryView,
                      meta: { title: 'История' },
                    },
                    {
                        path: ':id',
                        name: 'app.employment',
                        component: EmploymentView,
                        meta: {
                            title: 'Занятость',
                        }
                    },
                ],
            },
            {
                path: 'tests',
                children: [
                    {
                        path: '',
                        name: 'app.tests',
                        component: TestsView,
                        meta: {
                            title: 'Тесты',
                        }
                    },
                    {
                        path: ':code',
                        name: 'app.test',
                        component: TestView,
                        meta: {
                            title: 'Тест',
                        },
                        props: true,
                    },
                ],
            },
            {
                path: 'vacancies',
                children: [
                    {
                        path: '',
                        name: 'app.vacancies',
                        component: VacanciesView,
                        meta: {
                            title: 'Вакансии',
                        }
                    }
                ],
            },
            {
                path: 'faq',
                name: 'app.faq',
                component: FaqView,
                meta: {
                    title: 'Вопрос - Ответ',
                }
            },
            {
                path: 'profile',
                name: 'app.profile',
                component: ProfileView,
                meta: {
                    title: 'Профиль',
                },
            },
        ],
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: NotFound,
        meta: {
            title: '404 - Страница не найдена',
            requiresAuth: false,
        }
    }
];