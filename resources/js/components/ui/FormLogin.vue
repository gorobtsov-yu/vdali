<template>
  <form @submit.prevent="handleSubmit" class="max-w-sm mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl w-full text-center font-bold mb-6">Вход</h2>
    <div class="mb-4">
      <label class="block text-sm tex font-medium text-gray-700 mb-1">
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
    <div class="mb-12">
      <label class="block text-sm font-medium text-gray-700 mb-1">
        Пароль
      </label>
      <input
        v-model="formData.password"
        type="password"
        :class="inputClass('password')"
        @blur="validateField('password')"
      />
      <p v-if="errors.password" class="mt-1 text-sm text-red-600">
        {{ errors.password }}
      </p>
    </div>
    <ButtonBase 
        variant="outline"
        size="md"
        type="submit"
        :fullWidth="true"
    >
        Войти
    </ButtonBase>
  </form>
</template>

<script setup lang="ts">
import { useForm } from '@/js/components/composables/form'
import ButtonBase from './ButtonBase.vue'

const emit = defineEmits({
  submit: ({login, password}) => {
    if (login && password) {
      return true
    }
    return false
  }
})

const validationRules = {
  login: {
    required: true,
    min: 2,
    max: 50,
    message: 'Имя должно содержать от 2 до 50 символов'
  },
  password: {
    required: true,
    min: 6,
    message: 'Пароль должен содержать минимум 6 символов'
  }
}

const {
  formData,
  errors,
  isSubmitting,
  validateField,
  validateForm,
  submit
} = useForm(
  {
    login: '',
    password: ''
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
  
  if (s) { 
    emit('submit', formData)
  }
}
</script>