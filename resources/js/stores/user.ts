import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { userService } from '@/js/services/user';
import { User } from '../types/user';

export const useUserStore = defineStore('user', () => {
    const user = ref<User | null>(null);
    const loading = ref(false);
    const error = ref<string | null>(null);
    const onboardingCompleted = ref<boolean>(false);

    const isLoaded = computed(() => !!user.value);
    const fullName = computed(() => user.value?.full_name || '');
    const firstName = computed(() => user.value?.first_name || '');
    const lastName = computed(() => user.value?.last_name || '');
    const educationLevels = computed(() => user.value?.education_levels || []);
    const educationSpheres = computed(() => user.value?.education_spheres || []);
    const characteristics = computed(() => user.value?.characteristics || []);
    const activityTypes = computed(() => user.value?.activity_types || []);

    const fetchProfile = async () => {
        loading.value = true;
        error.value = null;

        try {
            const data = await userService.getProfile();
            user.value = data;
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Profile error';
            throw err;
        } finally {
            loading.value = false;
        }
    };

    const updateProfile = async (data: Partial<User>) => {
        loading.value = true;
        error.value = null;

        try {
            const updated = await userService.updateProfile(data);
            user.value = updated;
            return updated;
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Profile update error';
            throw err;
        } finally {
            loading.value = false;
        }
    };

    const hasCharacteristics = computed(() => {
        return (user.value?.characteristics?.length ?? 0) > 0;
    });

    const clearUser = () => {
        user.value = null;
        error.value = null;
        loading.value = false;
    };

    return {
        user,
        loading,
        error,
        isLoaded,
        fullName,
        firstName,
        lastName,
        educationLevels,
        educationSpheres,
        characteristics,
        activityTypes,
        hasCharacteristics,
        onboardingCompleted,
        fetchProfile,
        updateProfile,
        clearUser
    };
});