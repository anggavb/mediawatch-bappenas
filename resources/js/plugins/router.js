import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      redirect: () => {
        const token = localStorage.getItem('auth_token')
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
            const token = localStorage.getItem('auth_token')
            return token ? '/admin/dashboard' : '/login'
          },
        },
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: () => import('@/pages/admin/Dashboard.vue'),
        },
        {
          path: 'media-hub',
          name: 'MediaHub',
          component: () => import('@/pages/admin/MediaHub.vue'),
        },
        {
          path: 'analytic',
          name: 'Analytic',
          component: () => import('@/pages/admin/Analytic.vue'),
        },
        {
          path: 'settings',
          name: 'Settings',
          component: () => import('@/pages/admin/Settings.vue'),
        },
        {
          path: 'crud',
          name: 'Crud',
          component: () => import('@/pages/admin/Crud.vue'),
        },
      ],
    },
  ]
})

router.beforeEach(async (to, from, next) => {
  const { useAuthStore } = await import('@/stores/auth');
  const authStore = useAuthStore();
  
  // Public pages that don't need auth
  const publicPages = ['/login', '/register', '/forgot-password', '/verify-email'];
  const authRequired = !publicPages.includes(to.path) && !to.path.startsWith('/reset-password') && !to.path.startsWith('/confirm-password');

  // If page requires auth
  if (authRequired) {
    if (!authStore.token) {
        return next('/login');
    }
    
    // Optional: Verify token existence/validity via API on every navigation 
    // This addresses the user request "check if token is active when moving pages"
    // Note: This adds latency to navigation. 
    try {
        await authStore.checkAuth();
        if (!authStore.isAuthenticated) {
            return next('/login');
        }
    } catch (error) {
        return next('/login');
    }
  }

  // Redirect to dashboard if logged in and trying to access login
  if (to.path === '/login' && authStore.isAuthenticated) {
     // Verify one last time to be sure
     await authStore.checkAuth();
     if (authStore.isAuthenticated) {
        return next('/admin/dashboard');
     }
  }

  next();
});

export default router
