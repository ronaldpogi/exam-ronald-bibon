import { defineStore } from 'pinia'
import { ref } from 'vue'
import api from '@/plugins/axios'
import type { HomeInterface } from '@/interfaces/home'

export const useHomeStore = defineStore('home', () => {
  const home = ref<HomeInterface | null>(null)
  const loading = ref<boolean>(false)
  const error = ref<any>('')

  async function index() {
    loading.value = true
    try {
      const { data } = await api.get('/homePage')
      home.value = data.data ?? data
    } catch (err: any) {
      error.value = error.value.response?.data?.message || 'error'
      throw err
    } finally {
      loading.value = false
    }
  }

  return { home, loading, error, index }
})
