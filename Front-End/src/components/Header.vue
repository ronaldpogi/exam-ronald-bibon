<template>
  <ContactForm v-model="isOpenModal" />

  <header class="flex flex-wrap">
    <div class="w-full flex justify-start bg-[#001E5A] text-white lg:pl-10">
      <div class="flex items-center justify-center text-white">
        <a class="block" href="#">
          <span class="sr-only">Home</span>
          <img :src="globalStore.global?.logo" alt="" class="lg:h-15 h-auto w-full" />
        </a>
      </div>

      <div class="flex w-full items-center justify-end text-white">
        <div class="sm:flex sm:gap-2 md:gap-3 lg:my-7 mx-5">
          <a
            class="hidden rounded-md px-5 py-2.5 text-sm transition hover:bg-[#BBBBBB] lg:block bg-[#999999]"
            href="#"
          >
            Login
          </a>

          <a
            class="hidden rounded-md px-5 py-2.5 text-sm transition hover:bg-[#FAA41D] lg:block bg-[#FF7D00]"
            href="#"
          >
            Daftar sekarang
          </a>
          <button
            class="block rounded-md p-2.5 text-white transition lg:hidden"
            @click="toggleMenu"
            aria-controls="navbar-default"
          >
            <span class="sr-only">Toggle menu</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="size-8"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div class="w-full flex justify-start bg-[#003C82] text-white lg:pl-10">
      <nav
        aria-label="Global"
        :class="['w-full lg:block py-3', isOpen ? 'block' : 'hidden']"
        id="navbar-default"
      >
        <!-- <nav aria-label="Global" class="hidden md:block py-3 px-5"> -->
        <!-- <ul class="flex items-center gap-6 text[15px]"> -->
        <ul
          class="flex flex-col md:p-0 mt-4 lg:flex-row rtl:space-x-reverse md:mt-0 text[15px] gap-3"
        >
          <li
            class="border-b border-gray-500 shadow-[0_1px_3px_rgba(0,0,0,0.05)] pb-2 lg:border-b-0"
          >
            <a class="block transition text-[#FAA41D] px-8 font-bold" href="#"> Tentang OLE9777 </a>
          </li>

          <li
            class="border-b border-gray-500 shadow-[0_1px_3px_rgba(0,0,0,0.05)] pb-2 lg:border-b-0"
          >
            <a class="block transition text-white px-8" href="#"> Komisi </a>
          </li>

          <li
            class="border-b border-gray-500 shadow-[0_1px_3px_rgba(0,0,0,0.05)] pb-2 lg:border-b-0"
          >
            <a class="block transition text-white px-8" href="#"> Peraturan </a>
          </li>

          <li
            class="border-b border-gray-500 shadow-[0_1px_3px_rgba(0,0,0,0.05)] pb-2 lg:border-b-0"
          >
            <a class="block transition text-white px-8" href="#"> Pertanyaan & Jawaban </a>
          </li>

          <li
            class="border-b border-gray-500 shadow-[0_1px_3px_rgba(0,0,0,0.05)] pb-2 lg:border-b-0"
          >
            <a class="block lg:hidden transition text-white px-8" href="#"> Kontak </a>
          </li>

          <li
            class="border-b border-gray-500 shadow-[0_1px_3px_rgba(0,0,0,0.05)] pb-2 lg:border-b-0"
          >
            <a
              class="block transition lg:bg-[#faa41f] sm:text-[#FAA41D] rounded-sm lg:text-[#001e5a] font-bold px-8 cursor-pointer"
              type="button"
              @click="isOpenModal = true"
            >
              OLE777 Official
            </a>
          </li>
          <li
            class="border-b border-gray-500 shadow-[0_1px_3px_rgba(0,0,0,0.05)] pb-2 lg:border-b-0"
          >
            <a class="block lg:hidden transition text-white px-8" href="#"> Login </a>
          </li>
          <li class="">
            <a class="block lg:hidden transition text-white px-8" href="#"> Daftar sekarang </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import { useGlobalStore } from '@/stores/global'
import ContactForm from '@/views/home/ContactForm.vue'

const globalStore = useGlobalStore()

// Reactive state for mobile menu
const isOpen = ref(false)

const isOpenModal = ref<boolean>(false)

const toggleMenu = () => {
  isOpen.value = !isOpen.value
}
</script>

<style></style>
