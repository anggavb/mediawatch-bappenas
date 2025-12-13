import { createRouter, createWebHistory } from 'vue-router'
import { useLoadingStore } from '@/stores/loading';

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: () => import('@/layouts/DefaultLayout.vue'),
      children: [
        {
          path: '',
          name: 'Dashboard',
          component: () => import('@/pages/Dashboard.vue'),
        },
        {
          path: 'media',
          name: 'Media',
          component: () => import('@/pages/Media.vue'),
        },
        {
          path: 'analytic',
          name: 'Analytic',
          component: () => import('@/pages/Analytic.vue'),
        },
        {
            path: 'settings',
            name: 'Settings',
            component: () => import('@/pages/Settings.vue'),
        },
        {
            path: 'crud',
            name: 'Crud',
            component: () => import('@/pages/Crud.vue'),
        },
      ],
    },
  ]
})
