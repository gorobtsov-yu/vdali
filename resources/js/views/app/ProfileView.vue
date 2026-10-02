<template>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div v-if="loading" class="flex justify-center items-center min-h-[400px]">
            <div class="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin"></div>
        </div>

        <div v-else-if="error" class="text-center py-12">
            <p class="text-red-500">{{ error }}</p>
            <button 
                @click="loadProfile" 
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
            >
                Повторить
            </button>
        </div>

        <div v-else-if="user" class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                <div class="relative flex-shrink-0">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-blue-500 text-white flex items-center justify-center text-2xl sm:text-3xl font-semibold">
                        {{ user.first_name?.[0] }}{{ user.last_name?.[0] }}
                    </div>
                    <button 
                        @click="triggerFileInput"
                        class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors flex items-center justify-center border-2 border-white"
                    >
                        <i class="fa fa-camera text-gray-600 text-sm"></i>
                    </button>
                    <input
                        ref="fileInput"
                        type="file"
                        accept="image/*"
                        class="hidden"
                        @change=""
                    />
                </div>

                <div class="flex-1">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900">{{ user.full_name }}</h1>
                    <p class="text-gray-500 text-sm">@{{ user.login }}</p>
                    <p class="text-gray-400 text-sm">{{ user.email }}</p>
                </div>

                <button 
                    @click="editMode = !editMode" 
                    class="w-full sm:w-auto px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors flex items-center justify-center gap-2 text-gray-700"
                >
                    <i class="fa fa-pencil"></i>
                    {{ editMode ? 'Отмена' : 'Редактировать' }}
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                        Основная информация
                    </h3>
                    
                    <div v-if="editMode" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Имя</label>
                            <input 
                                v-model="editData.first_name" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Фамилия</label>
                            <input 
                                v-model="editData.last_name" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Отчество</label>
                            <input 
                                v-model="editData.middle_name" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Желаемая зарплата</label>
                            <input 
                                v-model="editData.desired_salary" 
                                type="number" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            />
                        </div>
                        <button 
                            @click="saveProfile" 
                            class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                        >
                            Сохранить
                        </button>
                    </div>

                    <div v-else class="space-y-3">
                        <div class="flex justify-between py-1">
                            <span class="text-gray-500 text-sm">Имя</span>
                            <span class="text-gray-900 font-medium">{{ user.first_name }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-500 text-sm">Фамилия</span>
                            <span class="text-gray-900 font-medium">{{ user.last_name }}</span>
                        </div>
                        <div v-if="user.middle_name" class="flex justify-between py-1">
                            <span class="text-gray-500 text-sm">Отчество</span>
                            <span class="text-gray-900 font-medium">{{ user.middle_name }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-500 text-sm">Желаемая зарплата</span>
                            <span class="text-gray-900 font-medium">
                                {{ user.desired_salary ? formatSalary(user.desired_salary) : 'Не указана' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div  v-if="!editMode" class="bg-white rounded-xl shadow-sm p-6">
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Уровень образования</h4>
                            <div v-if="educationLevels.length === 0" class="text-gray-400 text-sm">
                                Нет данных
                            </div>
                            <div v-else class="flex flex-wrap gap-2">
                                <span 
                                    v-for="level in educationLevels" 
                                    :key="level.id"
                                    class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
                                >
                                    {{ level.name }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Сфера образования</h4>
                            <div v-if="educationSpheres.length === 0" class="text-gray-400 text-sm">
                                Нет данных
                            </div>
                            <div v-else class="flex flex-wrap gap-2">
                                <span 
                                    v-for="sphere in educationSpheres" 
                                    :key="sphere.id"
                                    class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm"
                                >
                                    {{ sphere.name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                        Характеристики
                    </h3>
                    <div v-if="characteristics.length === 0" class="text-gray-400 text-sm">
                        Характеристики не получены
                    </div>
                    <div v-else class="space-y-2">
                        <div 
                            v-for="char in characteristics" 
                            :key="char.id"
                            class="flex justify-between py-2 px-3 bg-gray-50 rounded-lg"
                        >
                            <span class="text-gray-700">{{ char.name }}</span>
                            <span v-if="char.count" class="text-gray-900 font-medium">{{ char.count }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-100">
                        Типы деятельности
                    </h3>
                    <div v-if="activityTypes.length === 0" class="text-gray-400 text-sm">
                        Типы деятельности не получены
                    </div>
                    <div v-else class="flex flex-wrap gap-2">
                        <span 
                            v-for="activity in activityTypes" 
                            :key="activity.id"
                            class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-sm"
                        >
                            {{ activity.name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, reactive, computed } from 'vue';
import { useUserStore } from '@/js/stores/user';

const userStore = useUserStore();
const fileInput = ref<HTMLInputElement | null>(null);
const editMode = ref(false);

const editData = reactive({
    first_name: '',
    last_name: '',
    middle_name: '',
    desired_salary: null as number | null
});

const user = computed(() => userStore.user);
const loading = computed(() => userStore.loading);
const error = computed(() => userStore.error);
const educationLevels = computed(() => userStore.educationLevels);
const educationSpheres = computed(() => userStore.educationSpheres);
const characteristics = computed(() => userStore.characteristics);
const activityTypes = computed(() => userStore.activityTypes);

const loadProfile = async () => {
    await userStore.fetchProfile();
    if (user.value) {
        editData.first_name = user.value.first_name;
        editData.last_name = user.value.last_name;
        editData.middle_name = user.value.middle_name || '';
        editData.desired_salary = user.value.desired_salary;
    }
};

const saveProfile = async () => {
    await userStore.updateProfile({
        first_name: editData.first_name,
        last_name: editData.last_name,
        middle_name: editData.middle_name || null,
        desired_salary: editData.desired_salary
    });
    editMode.value = false;
};

// avatar?.. s3?..
const triggerFileInput = () => {
    fileInput.value?.click();
};

const formatSalary = (value: number) => {
    return new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: 'RUB',
        minimumFractionDigits: 0
    }).format(value);
};

onMounted(() => {
    loadProfile();
});
</script>