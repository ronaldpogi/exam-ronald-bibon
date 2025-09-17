<template>
  <div
    class="fixed top-5 right-5 inline-flex w-full max-w-sm ml-3 overflow-hidden bg-white rounded-lg shadow-md shadow-md z-50 animate-fadeIn"
  >
    <!-- Icon -->
    <div class="flex items-center justify-center w-12" :class="bgColor">
      <Icon class="text-white" :icon="iconName" width="36" height="36" />
    </div>

    <!-- Text -->
    <div class="px-4 py-2 -mx-3">
      <div class="mx-3">
        <span class="font-semibold" :class="textColor">{{ title }}</span>
        <p class="text-sm text-gray-600">{{ message }}</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

type AlertType = 'success' | 'info' | 'warning' | 'error' | string

interface AlertProps {
  bg: string
  text: string
  icon: string
}

const props = defineProps<{
  type?: AlertType
  title: string
  message: string
}>()

const typeMap: Record<AlertType, AlertProps> = {
  success: {
    bg: 'bg-green-500',
    text: 'text-green-500',
    icon: 'clarity:success-standard-line',
  },
  info: {
    bg: 'bg-blue-500',
    text: 'text-blue-500',
    icon: 'clarity:info-line',
  },
  warning: {
    bg: 'bg-yellow-500',
    text: 'text-yellow-500',
    icon: 'clarity:warning-line',
  },
  error: {
    bg: 'bg-red-500',
    text: 'text-red-500',
    icon: 'clarity:error-line',
  },
}

// Computed properties
const bgColor = computed(() => typeMap[props.type ?? 'success'].bg)
const textColor = computed(() => typeMap[props.type ?? 'success'].text)
const iconName = computed(() => typeMap[props.type ?? 'success'].icon)
</script>

<style>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeIn {
  animation: fadeIn 0.3s ease-out forwards;
}
</style>
