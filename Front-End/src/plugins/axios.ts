import { useToastStore } from '@/stores/toast'
import axios from 'axios'

const api = axios.create({
  baseURL: `https://dev-exam.777tech.me/senior_level/api`,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
})

api.interceptors.request.use()

api.interceptors.response.use(
  (response) => {
    const toast = useToastStore()
    // Example: show success toast for specific responses
    // Adjust the condition based on your API structure
    if (response.config.method !== 'get') {
      // maybe only for POST/PUT/DELETE
      toast.addAlert(
        'success',
        'Success',
        response.data.message || 'Operation completed successfully.',
      )
    }
    return response
  },
  (error) => {
    const toast = useToastStore()
    toast.addAlert('error', 'Error', error.response?.data?.message || 'Something went wrong')
    return Promise.reject(error)
  },
)

export default api
