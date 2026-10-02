import api from '@/js/services/axios';
import type { User } from '@/js/types/user';
import { IndexEmployment } from '../types/employment';

export const userService = {
    async getProfile(): Promise<User> {
        const response = await api.get('/users/me');
        return response.data;
    },

    async updateProfile(data: Partial<User>): Promise<User> {
        const response = await api.patch('/users/me', data);
        return response.data;
    },

    getLevel(recommendations: IndexEmployment[]): number {
        let level = 0;

        if (recommendations.filter((e) => e.metrics.total >= 80).length > 2) {
            level += 1;
        }

        if (recommendations.filter((e) => e.is_favorite).length > 1) {
            level += 1;
        }

        return level;
    }
};