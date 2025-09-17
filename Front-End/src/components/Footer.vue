<template>
  <div class="flex justify-center items-center bg-[#001E5A] justify-between md:gap-20">
    <div class="p-4" v-for="x in filteredFooter" :key="x.name">
      <img :src="x.img" alt="" class="w-full h-auto" />
    </div>
  </div>
</template>

<script lang="ts" setup>
import { useGlobalStore } from '@/stores/global'
import { onMounted, computed } from 'vue'

const globalStore = useGlobalStore()

const filteredFooter = computed(() => {
  return globalStore.global?.footer?.filter((item) => !(item.name === 'Pagcor Philippines')) ?? []
})

onMounted(async () => {
  await globalStore.index()
})
</script>

<style></style>
