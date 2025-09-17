import { reactive, ref } from 'vue'
import { defineStore } from 'pinia'
import api from '@/plugins/axios'

export const useContactStore = defineStore('contact', () => {
  interface FormInterface {
    fullname: string
    email: string
    subject: string
    message: string
  }

  const loading = ref<boolean>(false)
  const errors = ref<any>({})

  const form = reactive<FormInterface>({
    fullname: '',
    email: '',
    subject: '',
    message: '',
  })

  async function submit() {
    loading.value = true

    try {
      errors.value = {}
      const formData = new FormData()
      formData.append('fullname', form.fullname)
      formData.append('email', form.email)
      formData.append('subject', form.subject)
      formData.append('message', form.message)

      await api.post('https://dev-exam.777tech.me/senior_level/api/sendMessage', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // Reset form
      form.fullname = ''
      form.email = ''
      form.subject = ''
      form.message = ''
    } catch (err: any) {
      errors.value = err.response?.data?.errors.field || 'error'
    } finally {
      loading.value = false
    }
  }

  return { submit, form, errors, loading }
})
