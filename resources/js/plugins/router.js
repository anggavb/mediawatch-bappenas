import { createRouter, createWebHistory } from 'vue-router'
import { useLoadingStore } from '@/stores/loading';

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      redirect: () => {
        localStorage.removeItem('token') // cuma buat implement auth
        const token = localStorage.getItem('token')
        return token ? '/admin/dashboard' : '/login'
      },
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import('@/pages/auth/Login.vue'),
    },
    {
      path: '/register',
      name: 'Register',
      component: () => import('@/pages/auth/Register.vue'),
    },
    {
      path: '/forgot-password',
      name: 'ForgotPassword',
      component: () => import('@/pages/auth/ForgotPassword.vue'),
    },
    {
      path: '/reset-password/:token',
      name: 'ResetPassword',
      component: () => import('@/pages/auth/ResetPassword.vue'),
    },
    {
      path: '/verify-email',
      name: 'VerifyEmail',
      component: () => import('@/pages/auth/VerifyEmail.vue'),
    },
    {
      path: '/confirm-password',
      name: 'ConfirmPassword',
      component: () => import('@/pages/auth/ConfirmPassword.vue'),
    },

    {
      path: '/admin',
      component: () => import('@/layouts/AdminLayout.vue'),
      children: [
        {
          path: '',
          redirect: () => {
            localStorage.setItem('token', 'asd') // cuma buat implement auth
            const token = localStorage.getItem('token')
            return token ? '/admin/dashboard' : '/login'
          },
        },
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: () => import('@/pages/Dashboard.vue'),
        },
        {
          path: 'media-hub',
          name: 'MediaHub',
          component: () => import('@/pages/MediaHub.vue'),
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
