<template>
    <div class="w-full absolute z-10 overflow-x-hidden">
        <!-- ГЕРОЙ-СЕКЦИЯ -->
        <section class="relative w-full max-w-[100vw] h-[45vh] md:h-[70vh] min-h-[340px] overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <img 
                    class="absolute inset-0 w-full h-full max-w-full object-cover object-center" 
                    :src="banner" 
                    alt="баннер"
                />
            </div>

            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/70"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
            
            <div class="relative h-full flex items-end pb-12 md:pb-20">
                <div class="w-full px-[8%] md:px-[12.5%]">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold text-white tracking-[0.1em] uppercase drop-shadow-2xl break-words">
                        ВДАЛИ
                    </h1>
                    <div class="mt-4 h-1 w-24 bg-white/80 rounded-full"></div>
                </div>
            </div>
        </section>

        <!-- ОСНОВНОЙ ТЕКСТ -->
        <div class="w-full max-w-[100vw] px-[8%] md:px-[12.5%] py-16 md:py-20">
            <div class="max-w-4xl">
                <span class="inline-block text-xs font-semibold tracking-[0.2em] uppercase text-[#5a7fb8] mb-4">
                    О проекте
                </span>
                <div class="text-gray-700 space-y-6 text-base sm:text-lg leading-relaxed">
                    <p class="text-xl md:text-2xl text-gray-800 font-light leading-relaxed">
                        <span class="font-semibold text-[#5a7fb8]">ВДАЛИ</span> — это платформа для профориентации и поиска подходящих рабочих мест, для людей с ОВЗ в частности.
                    </p>
                    <p>
                        Мы предоставляем возможность многоэтапного диалога, позволяющую пользователям раскрыть свои интересы и желания, найти свое призвание и построить четкий вектор для движения к своей цели.
                    </p>
                    <p>
                        Вы можете найти похожих себе людей и узнать о реальных случаях их трудоустройства.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA + ФОРМА -->
        <div class="w-full max-w-[100vw] px-[8%] md:px-[12.5%] pb-20">
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#c5d2e8] to-[#a8bcd9] shadow-xl">
                <div class="pointer-events-none absolute -top-16 -right-16 w-64 h-64 rounded-full bg-white/20 blur-2xl"></div>
                <div class="pointer-events-none absolute -bottom-20 -left-10 w-72 h-72 rounded-full bg-white/10 blur-3xl"></div>
                
                <div class="relative px-8 md:px-16 py-12 md:py-16">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white/40 flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#3b5580]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold tracking-[0.2em] uppercase text-[#3b5580] mt-3">
                            Тестирование
                        </span>
                    </div>
                    
                    <p class="text-gray-800 text-lg md:text-xl leading-relaxed max-w-3xl">
                        В настоящий момент проект находится на стадии тестирования базового функционала. 
                        Если вы желаете принять участие в тестировании платформы, 
                        <span class="font-semibold text-[#3b5580]">оставьте заявку в форме ниже</span>.
                    </p>

                    <!-- ФОРМА ЗАЯВКИ -->
                    <form 
                        id="form"
                        @submit.prevent="handleSubmit" 
                        class="mt-10 max-w-2xl mx-auto p-6 md:p-8 bg-white/95 backdrop-blur-sm rounded-xl shadow-lg"
                    >
                        <h2 class="text-2xl w-full text-center font-bold mb-6 text-[#3b5580]">Заявка на тестирование</h2>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Логин
                            </label>
                            <input
                                v-model="formData.login"
                                type="text"
                                :class="inputClass('login')"
                                @blur="validateField('login')"
                            />
                            <p v-if="errors.login" class="mt-1 text-sm text-red-600">
                                {{ errors.login }}
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Имя
                                </label>
                                <input
                                    v-model="formData.first_name"
                                    type="text"
                                    :class="inputClass('first_name')"
                                    @blur="validateField('first_name')"
                                />
                                <p v-if="errors.first_name" class="mt-1 text-sm text-red-600">
                                    {{ errors.first_name }}
                                </p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Фамилия
                                </label>
                                <input
                                    v-model="formData.last_name"
                                    type="text"
                                    :class="inputClass('last_name')"
                                    @blur="validateField('last_name')"
                                />
                                <p v-if="errors.last_name" class="mt-1 text-sm text-red-600">
                                    {{ errors.last_name }}
                                </p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Отчество
                            </label>
                            <input
                                v-model="formData.middle_name"
                                type="text"
                                :class="inputClass('middle_name')"
                                @blur="validateField('middle_name')"
                            />
                            <p v-if="errors.middle_name" class="mt-1 text-sm text-red-600">
                                {{ errors.middle_name }}
                            </p>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email
                            </label>
                            <input
                                v-model="formData.email"
                                type="email"
                                :class="inputClass('email')"
                                @blur="validateField('email')"
                            />
                            <p v-if="errors.email" class="mt-1 text-sm text-red-600">
                                {{ errors.email }}
                            </p>
                        </div>

                        <ButtonBase 
                            variant="outline"
                            size="md"
                            type="submit"
                            :fullWidth="true"
                            :disabled="isSubmitting"
                        >
                            Отправить заявку
                        </ButtonBase>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import banner from '@/images/banner/banner.png';
    import { useForm } from '@/js/components/composables/form'
    import api from '@/js/services/axios';

const validationRules = {
  login: {
    required: true,
    min: 2,
    max: 32,
    message: 'Имя должно содержать от 2 до 50 символов'
  },
  first_name: {
    required: true,
    min: 1,
    message: 'Введите имя'
  },
  last_name: {
    required: true,
    min: 1,
    message: 'Введите фамилию'
  },
  middle_name: {
    required: false,
    min: 0,
    message: 'Введите отчество'
  },
  email: {
    required: true,
    min: 1,
    message: 'Введите почту'
  }
}

const {
  formData,
  errors,
  isSubmitting,
  validateField,
  validateForm,
} = useForm(
  {
    login: '',
    first_name: '',
    last_name: '',
    middle_name: '',
    email: ''
  },
  validationRules,
)

const inputClass = (field: keyof typeof formData) => {
  return [
    'w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 transition-colors',
    errors.value[field]
      ? 'border-red-500 focus:ring-red-500'
      : 'border-gray-300 focus:ring-blue-500'
  ]
}

const handleSubmit = async () => {
  const s = validateForm()
  if (!s) return

  const response = await api.post('/registration-requests', {
    login: formData.login,
    first_name: formData.first_name,
    last_name: formData.last_name,
    middle_name: formData.middle_name,
    email: formData.email
  })
  if (response) {
    alert('Заявка успешно отправлена!');
  }
}
</script>