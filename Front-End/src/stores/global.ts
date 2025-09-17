import { defineStore } from 'pinia'
import { ref } from 'vue'
import api from '@/plugins/axios'
import type { GlobalInterface } from '@/interfaces/global'

export const useGlobalStore = defineStore('global', () => {
  const global = ref<GlobalInterface | null>(null)
  const loading = ref<boolean>(false)
  const error = ref<any>('')

  async function index() {
    loading.value = true
    try {
      const { data } = await api.get('/global')
      global.value = data.data ?? data
    } catch (err: any) {
      error.value = error.value.response?.data?.message || 'error'
      throw err
    } finally {
      loading.value = false
    }
  }

  return { global, loading, error, index }
})
