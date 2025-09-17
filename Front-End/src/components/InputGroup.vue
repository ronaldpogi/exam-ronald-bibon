<template>
  <label class="block flex-1 mt-2">
    <span v-if="label" class="text-[12px] text-gray-700">{{ label }} : </span>

    <input
      v-bind="$attrs"
      v-model="model"
      :type="type"
      class="text-[15px] block w-full border-gray-300 border py-1 px-2 focus:outline-none focus:ring-0 focus:border-indigo-500 rounded"
    />

    <small v-if="error" class="text-red-500 text-xs mt-1">{{ error }}</small>
  </label>
</template>

<script lang="ts" setup>
import { computed } from 'vue'

const props = defineProps<{
  label?: string
  type?: string
  modelValue: string | number
  error?: string
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string | number): void
}>()

// make v-model work
const model = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val),
})
</script>
