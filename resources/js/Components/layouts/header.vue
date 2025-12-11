<template>
  <aside class="sidebar" :class="{ 'sidebar-open': isMobileOpen }">
    <!-- Mobile Close -->
    <button type="button" class="sidebar-close-btn" @click="closeSidebar">
      <iconify-icon icon="radix-icons:cross-2" />
    </button>

    <!-- Logo -->
    <Link href="/" class="sidebar-logo">
      <img src="@assets/images/logo.png" alt="Logo" class="light-logo" />
      <img src="@assets/images/logo-light.png" alt="Logo" class="dark-logo" />
      <img src="@assets/images/logo-icon.png" alt="Logo" class="logo-icon" />
    </Link>

    <!-- Menu -->
    <div class="sidebar-menu-area">
      <ul class="sidebar-menu">
        <!-- Dashboard Section -->
        <li>
          <Link href="/" @click="() => goToRoute('/')" :class="{ 'active-page': isActive('/') }">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon" />
            <span>Dashboard</span>
          </Link>
        </li>

        <!-- Media Section -->
        <li :class="{ dropdown: true, open: activeDropdown === 'media' }">
          <!-- <a href="javascript:void(0)" @click="toggleDropdown('media')" :class="{ active: isDashboardActive }"> -->
          <a href="javascript:void(0)" @click="toggleDropdown('media')">
            <iconify-icon icon="material-symbols:web" class="menu-icon"></iconify-icon>
            <span class="dropdown-arrow" :class="{ rotated: activeDropdown === 'media' }">Media</span>
          </a>
          <transition @before-enter="beforeEnter" @enter="enter" @after-enter="afterEnter" @before-leave="beforeLeave"
            @leave="leave" @after-leave="afterLeave">
            <ul v-show="activeDropdown === 'media'" class="sidebar-submenu">
              <li v-for="item in mediaItems" :key="item.path" :class="['nav-link', { 'active-page': isActive(item.path) }]">
                <Link :href="item.path">
                  <i class="ri-circle-fill circle-icon" :class="item.colorClass" />{{ item.label }}</Link>
              </li>
            </ul>
          </transition>
        </li>

        <!-- Article Section -->
        <li :class="{ dropdown: true, open: activeDropdown === 'article' }">
          <a href="javascript:void(0)" @click="toggleDropdown('article')">
            <iconify-icon icon="material-symbols:breaking-news-outline" class="menu-icon"></iconify-icon>
            <span class="dropdown-arrow" :class="{ rotated: activeDropdown === 'article' }">Article</span>
          </a>
          <transition @before-enter="beforeEnter" @enter="enter" @after-enter="afterEnter" @before-leave="beforeLeave"
            @leave="leave" @after-leave="afterLeave">
            <ul v-show="activeDropdown === 'article'" class="sidebar-submenu">
              <li v-for="item in articleItems" :key="item.path" :class="['nav-link', { 'active-page': isActive(item.path) }]">
                <Link :href="item.path">
                  <i class="ri-circle-fill circle-icon" :class="item.colorClass" />{{ item.label }}</Link>
              </li>
            </ul>
          </transition>
        </li>

        <!-- Blank Page -->
        <li>
          <Link href="/blank-page" @click="() => goToRoute('/blank-page')"
            :class="{ 'active-page': isActive('/blank-page') }">
            <i class="ri-checkbox-multiple-blank-line text-xl me-14 d-flex w-auto"></i>
            <span>Blank Page</span>
          </Link>
        </li>

        <!-- Settings Section -->
        <li :class="{ dropdown: true, open: activeDropdown === 'settings' }">
          <a href="javascript:void(0)" @click="toggleDropdown('settings')">
            <iconify-icon icon="material-symbols:settings-outline" class="menu-icon"></iconify-icon>
            <span class="dropdown-arrow" :class="{ rotated: activeDropdown === 'settings' }">Settings</span>
          </a>
          <transition @before-enter="beforeEnter" @enter="enter" @after-enter="afterEnter" @before-leave="beforeLeave"
            @leave="leave" @after-leave="afterLeave">
            <ul v-show="activeDropdown === 'settings'" class="sidebar-submenu">
              <li v-for="item in settingsItems" :key="item.path" :class="['nav-link', { 'active-page': isActive(item.path) }]">
                <Link :href="item.path">
                  <i class="ri-circle-fill circle-icon" :class="item.colorClass" />{{ item.label }}</Link>
              </li>
            </ul>
          </transition>
        </li>

      </ul>
    </div>
  </aside>
</template>


<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref, computed, onMounted } from 'vue'

const page = usePage()
const activeDropdown = ref(null)
const isMobileOpen = ref(false)

const currentPath = computed(() => page.url)

const toggleDropdown = (name) => {
  activeDropdown.value = activeDropdown.value === name ? null : name
  localStorage.setItem('activeDropdown', activeDropdown.value || '')
}

onMounted(() => {
  const savedDropdown = localStorage.getItem('activeDropdown')
  if (savedDropdown) {
    activeDropdown.value = savedDropdown
  }
})

const closeSidebar = () => {
  isMobileOpen.value = false
  document.body.classList.remove('overlay-active')
  const asideEl = document.querySelector('aside.sidebar')
  if (asideEl) {
    asideEl.classList.remove('sidebar-open')
  }
}

const goToRoute = (path) => {
  activeDropdown.value = null
  closeSidebar()
  localStorage.removeItem('activeDropdown')
}

const isActive = (path) => currentPath.value === path

const mediaItems = [
  { path: '/media-list', label: 'Overview', colorClass: 'text-primary-600 w-auto' },
  { path: '/media-preview', label: 'Preview', colorClass: 'text-warning-main w-auto' },
  { path: '/media-add', label: 'Add new', colorClass: 'text-info-main w-auto' },
  { path: '/media-edit', label: 'Edit', colorClass: 'text-danger-main w-auto' },
]

const articleItems = [
  { path: '/article-list', label: 'List', colorClass: 'text-primary-600 w-auto' },
  { path: '/article-preview', label: 'Preview', colorClass: 'text-warning-main w-auto' },
  { path: '/article-add', label: 'Add new', colorClass: 'text-info-main w-auto' },
  { path: '/article-edit', label: 'Edit', colorClass: 'text-danger-main w-auto' },
]

const settingsItems = [
  { path: '/profile-settings', label: 'Profile', colorClass: 'text-primary-600 w-auto' },
]

function beforeEnter(el) {
  el.style.height = '0px';
  el.style.opacity = '0';
  el.style.overflow = 'hidden';
}

function enter(el) {
  el.style.transition = 'height 0.7s ease';
  el.style.height = el.scrollHeight + 'px';
  el.style.opacity = '1';
}

function afterEnter(el) {
  el.style.height = 'auto';
  el.style.overflow = '';
  el.style.transition = '';
}

function beforeLeave(el) {
  el.style.height = el.scrollHeight + 'px';
  el.style.opacity = '1';
  el.style.overflow = 'hidden';
}

function leave(el) {
  el.style.transition = 'height 0.7s ease';
  requestAnimationFrame(() => {
    el.style.height = '0px';
    el.style.opacity = '0';
  });
}

function afterLeave(el) {
  el.style.height = '';
  el.style.opacity = '';
  el.style.transition = '';
  el.style.overflow = '';
}
</script>
