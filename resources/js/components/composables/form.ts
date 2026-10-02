import { reactive, ref, toRaw } from 'vue'

type ValidationRule = {
  required?: boolean
  min?: number
  max?: number
  pattern?: RegExp
  message?: string
}

type ValidationRules<T> = {
  [K in keyof T]?: ValidationRule
}

export function useForm<T extends Record<string, any>>(
  initialData: T,
  rules?: ValidationRules<T>
) {
  const formData = reactive(initialData) as { [K in keyof T]: T[K] }
  const errors = ref<Partial<Record<keyof T, string>>>({})
  const isSubmitting = ref(false)
  
  const getFieldValue = <K extends keyof T>(field: K): T[K] => {
    return toRaw(formData)[field]
  }
  
  const setFieldValue = <K extends keyof T>(field: K, value: T[K]) => {
    formData[field] = value
  }
  
  const validateField = <K extends keyof T>(field: K): boolean => {
    const value = getFieldValue(field)
    const rule = rules?.[field]
    
    if (!rule) return true
    
    if (errors.value[field]) {
      const newErrors = { ...errors.value }
      delete newErrors[field]
      errors.value = newErrors
    }
    
    if (rule.required && (value === undefined || value === null || value === '')) {
      errors.value = {
        ...errors.value,
        [field]: rule.message || 'Поле обязательно для заполнения'
      }
      return false
    }
    
    if (rule.min && typeof value === 'string' && value.length < rule.min) {
      errors.value = {
        ...errors.value,
        [field]: rule.message || `Минимум ${rule.min} символов`
      }
      return false
    }
    
    if (rule.max && typeof value === 'string' && value.length > rule.max) {
      errors.value = {
        ...errors.value,
        [field]: rule.message || `Максимум ${rule.max} символов`
      }
      return false
    }
    
    if (rule.pattern && typeof value === 'string' && !rule.pattern.test(value)) {
      errors.value = {
        ...errors.value,
        [field]: rule.message || 'Некорректный формат'
      }
      return false
    }
    
    return true
  }
  
  const validateForm = (): boolean => {
    let isValid = true
    
    if (rules) {
      for (const field in rules) {
        if (!validateField(field as keyof T)) {
          isValid = false
        }
      }
    }
    
    return isValid
  }
  
  const resetForm = () => {
    Object.assign(formData, initialData)
    errors.value = {}
  }
  
  const submit = async (callback: (data: T) => Promise<void>): Promise<boolean> => {
    if (!validateForm()) return false
    
    isSubmitting.value = true
    
    try {
      await callback(toRaw(formData) as T)
      resetForm()
    } catch (error) {
      console.error('Submit error:', error)
      throw error
    } finally {
      isSubmitting.value = false
    }

    return true
  }
  
  return {
    formData,
    errors: errors,
    isSubmitting,
    getFieldValue,
    setFieldValue,
    validateField,
    validateForm,
    resetForm,
    submit
  }
}