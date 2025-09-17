<template>
  <Modal
    heading="Contact Us"
    action="confirm"
    v-model="isOpen"
    :showFooter="true"
    @submit="handleSubmit"
  >
    <form class="mb-8" @submit.prevent="handleSubmit">
      <InputGroup
        label="FULL NAME"
        v-model="contactStore.form.fullname"
        :error="contactStore.errors.fullname"
      />
      <InputGroup
        label="EMAIL"
        v-model="contactStore.form.email"
        :error="contactStore.errors.email"
      />
      <InputGroup
        label="SUBJECT"
        v-model="contactStore.form.subject"
        :error="contactStore.errors.subject"
      />
      <TextAreaGroup
        label="MESSAGE"
        v-model="contactStore.form.message"
        :error="contactStore.errors.message"
      />
    </form>
  </Modal>
</template>

<script lang="ts" setup>
import InputGroup from '@/components/InputGroup.vue'
import Modal from '@/components/Modal.vue'
import TextAreaGroup from '@/components/TextAreaGroup.vue'
import { useContactStore } from '@/stores/contact'
import { computed } from 'vue'

const contactStore = useContactStore()

const props = defineProps({
  modelValue: { type: Boolean, required: true },
})

const handleSubmit = async () => {
  await contactStore.submit()

  // Close modal if there are no errors
  if (Object.keys(contactStore.errors).length === 0) {
    isOpen.value = false
  }
}

const emit = defineEmits(['update:modelValue'])

const isOpen = computed({
  get: () => props.modelValue,
  set: (value: boolean) => emit('update:modelValue', value),
})
</script>

<style></style>
