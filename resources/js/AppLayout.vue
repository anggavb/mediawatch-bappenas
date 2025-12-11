<template>
  <div id="app">
    <Header v-if="showLayout" />
    <main :class="showLayout ? 'dashboard-main' : ''">
      <Navbar v-if="showLayout" />
      <slot />
      <Footer v-if="showLayout" />
    </main>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Header from '@components/layouts/header.vue'
import Navbar from '@components/layouts/navbar.vue'
import Footer from '@components/layouts/footer.vue'

const page = usePage()
const showLayout = computed(() => page.props.showLayout !== false)
</script>
