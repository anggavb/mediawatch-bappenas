import { createRouter, createWebHistory } from 'vue-router'
import { useLoadingStore } from '@/stores/loading';

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Dashboard',
      component: () => import('@/pages/Dashboard.vue'),
    },
    {
      path: '/media-hub',
      name: 'MediaHub',
      component: () => import('@/pages/MediaHub.vue'),
    },
    {
      path: '/analytic',
      name: 'Analytic',
      component: () => import('@/pages/Analytic.vue'),
    },
    {
        path: '/settings',
        name: 'Settings',
        component: () => import('@/pages/Settings.vue'),
    },
    {
        path: '/crud',
        name: 'Crud',
        component: () => import('@/pages/Crud.vue'),
    },
  ]
})
