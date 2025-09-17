<template>
  <label class="block flex-1 mt-2">
    <span v-if="label" class="text-[12px] text-gray-700">{{ label }} : </span>

    <textarea
      v-bind="$attrs"
      v-model="model"
      :rows="rows"
      class="text-[15px] block w-full border-gray-300 border py-1 px-2 focus:outline-none focus:ring-0 focus:border-indigo-500 rounded resize-none"
    ></textarea>

    <small v-if="error" class="text-red-500 text-xs mt-1">{{ error }}</small>
  </label>
</template>

<script lang="ts" setup>
import { computed } from 'vue'

const props = defineProps<{
  label?: string
  modelValue: string
  error?: string
  rows?: number
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

// make v-model work
const model = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val),
})

// default rows if not provided
const rows = props.rows ?? 4
</script>
