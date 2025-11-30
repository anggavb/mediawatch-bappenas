<template>
  <div id="app">
    <Header v-if="showLayout" />
    <main :class="showLayout ? 'dashboard-main' : ''">
      <Navbar v-if="showLayout" />
      <router-view />
      <Footer v-if="showLayout" />
    </main>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import Header from '@/layouts/header.vue'
import Navbar from '@/layouts/navbar.vue'
import Footer from '@/layouts/footer.vue'

const route = useRoute()
const showLayout = computed(() => route.meta.layout !== false)
</script>