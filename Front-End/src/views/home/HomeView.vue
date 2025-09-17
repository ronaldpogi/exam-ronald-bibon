<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue'
import { useHomeStore } from '@/stores/home'
import { useGlobalStore } from '@/stores/global'
import { onMounted } from 'vue'

const homeStore = useHomeStore()
const globalStore = useGlobalStore()

onMounted(async () => {
  await homeStore.index()
})
</script>

<template>
  <MainLayout>
    <div class="fixed flex-row w-full top-10 left-5 z-50 flex justify-left pointer-events-none">
      <div
        class="flex flex-col lg:flex-row justify-between text-white px-6 py-4 rounded-lg w-full max-w-screen-xl gap-4"
      >
        <div class="lg:text-left space-y-2">
          <!-- Gradient text, hide below lg -->
          <h2
            class="text-[3rem] font-bold hidden lg:inline-block bg-gradient-to-t from-[#faa41f] to-[#FEF85A] bg-clip-text text-transparent font-bold text-3xl pointer-events-none"
          >
            50% INSTANT KOMISI AFILIASI
          </h2>

          <!-- Hidden on small screens -->
          <div class="hidden sm:block space-y-1 text-sm lg:mb-10 pointer-events-none">
            <span class="text-[2rem] font-bold">TAMBAH PENGHASILAN ANDA</span> <br />
            <span class="text-[2rem] font-bold">PASSIVE INCOME MENGGIURKAN!</span>
          </div>

          <!-- Button, interactive -->
          <a
            href="https://aff.oleafiliasi.com/affiliate/register/92337024"
            class="hidden sm:block w-40 text-center bg-[#FF7D00] hover:bg-[#e06d00] text-white font-bold py-2 px-4 rounded shadow pointer-events-auto"
          >
            Daftar Sekarang
          </a>
        </div>
      </div>
    </div>

    <!-- <div class="fixed top-1/2 right-10 -translate-y-1/2">
      <button
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-5 rounded-full shadow-lg cursor-pointer"
        @click="isOpen = true"
      >
        <Icon icon="tabler:message" width="35" height="35" />
      </button>
    </div> -->

    <div
      class="flex justify-center items-center gap-4 bg-gray-300 p-4 overflow-x-auto lg:gap-10 scrollbar-hide lg:py-10"
    >
      <div v-for="x in homeStore.home?.offers" :key="x.id" class="flex-shrink-0 w-60 lg:w-1/4">
        <img :src="x.img" alt="" class="w-full h-auto rounded-lg" />
      </div>
    </div>

    <div class="flex justify-center items-center bg-gray-300 p-5 text-[#505050]">
      <div class="services-content" v-html="homeStore.home?.content"></div>
    </div>

    <div class="flex flex-wrap justify-center items-start p-5 text-[#505050] gap-6 bg-gray-300">
      <div
        class="flex flex-col items-center text-center p-4 rounded-lg w-1/3 lg:w-60"
        v-for="x in homeStore.home?.services"
        :key="x.id"
      >
        <img :src="x.img" alt="" class="w-20 h-20 rounded-lg mb-3" />
        <h2 class="text-lg font-bold mb-2 text-[#00276C]">{{ x.title }}</h2>
        <p class="text-sm hidden lg:block">{{ x.description }}</p>
      </div>
    </div>

    <div class="flex justify-center items-center bg-gray-200 p-5">
      <a>
        <img
          class="w-full h-auto"
          :src="globalStore.global?.download_app.img"
          alt=""
          :href="globalStore.global?.download_app.link"
        />
      </a>
    </div>

    <div class="hidden sm:flex justify-center items-center gap-6 bg-[#003C82] p-4 flex-wrap">
      <div
        v-for="x in globalStore.global?.contact"
        :key="x.img"
        class="flex items-center gap-3 px-4 py-2"
      >
        <img :src="x.img" alt="" class="w-8 h-8 rounded-full" />
        <span class="text-white text-sm font-bold">
          {{ x.label }}:
          <a :href="`mailto:${x.value}`" class="underline text-[#FAA41D] font-semi-bold">{{
            x.value
          }}</a>
        </span>
      </div>
    </div>
  </MainLayout>
</template>

<style>
/* Hide scrollbar for Webkit browsers */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge, Firefox */
.scrollbar-hide {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
.services-content ul.steps li span {
  background: #faa41d;
  color: #fff;
  padding: 0px 7px;
  border-radius: 3px;
  margin-right: 4px;
}
</style>
