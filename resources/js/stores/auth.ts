import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import api from '@/js/services/axios';
import { useUserStore } from './user';

interface User {
    login: string;
    token: string;
}

export const useAuthStore = defineStore('auth', () => {
    interface loginResponse {
        success: boolean
        error?: string
    }
    
    const user = ref<User | null>(null);
    const isChecked = ref(false);
    let checkPromise: Promise<void> | null = null;
    
    const isAuthenticated = computed(() => !!user.value);
    
    const checkAuth = async (): Promise<loginResponse | boolean | void> => {
    
        if (checkPromise) {
            return checkPromise;
        }
        
        if (isChecked.value) {
            return false;
        }
        
        /**
         * Mozhno peredelat pod proverky nalichiya tokena na fronte
         */
        checkPromise = (async () => {
            try {
                const response = await api.get('/users/me');
                user.value = response.data;
            } catch (error) {
                user.value = null;
            } finally {
                isChecked.value = true;
                checkPromise = null;
            }
        })();
        
        return checkPromise;
    };
    
    const login = async (login: string, password: string) => {
        isChecked.value = false;
        checkPromise = null;
        
        try {
            const creds = { login: login, password: password };
            const response = await api.post('/auth/login', creds);
            if (response.data) {
                user.value = response.data;

                const userStore = useUserStore();
                await userStore.fetchProfile();

                isChecked.value = true;
                return { success: true };
            }
            return { success: false, error: 'Login error' };
        } catch (error: any) {
            return { 
                success: false, 
                error: error.response?.data?.message || 'Unknown error' 
            };
        }
    };
    
    const logout = async (): Promise<boolean> => {
        try {
            await api.post('/auth/logout');
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            user.value = null;
            isChecked.value = false;
            checkPromise = null;
        }

        return true;
    };
    
    return {
        user,
        isChecked,
        isAuthenticated,    
        checkAuth,
        login,
        logout,
    };
});