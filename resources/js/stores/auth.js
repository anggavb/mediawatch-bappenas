import { defineStore } from 'pinia';
import api from '@/api';
import router from '@/plugins/router';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem('auth_token') || null,
        isAuthenticated: !!localStorage.getItem('auth_token'),
    }),

    actions: {
        async login(credentials) {
            try {
                const response = await api.auth.login(credentials);
                const token = response.data.token;
                
                this.setToken(token);
                await this.fetchUser();
                
                return response;
            } catch (error) {
                this.logout();
                throw error;
            }
        },

        async fetchUser() {
            try {
                if (!this.token) return;
                const response = await api.auth.me();
                this.user = response.data;
                this.isAuthenticated = true;
            } catch (error) {
                this.isAuthenticated = false;
                this.user = null;
                // If 401, token is invalid
                if (error.response && error.response.status === 401) {
                    this.logout();
                }
            }
        },

        async logout() {
            try {
                if (this.token) {
                    // Try to call backend logout, but don't block client logout on failure
                   await api.auth.logout().catch(() => {}); 
                }
            } finally {
                this.setToken(null);
                this.user = null;
                this.isAuthenticated = false;
                router.push('/login');
            }
        },

        setToken(token) {
            this.token = token;
            if (token) {
                localStorage.setItem('auth_token', token);
                this.isAuthenticated = true;
            } else {
                localStorage.removeItem('auth_token');
                this.isAuthenticated = false;
            }
        },

        async checkAuth() {
            if (!this.token) {
                this.isAuthenticated = false;
                return false;
            }
            // Verify token by fetching user
            // Optimization: You might want to skip this if we just fetched the user recently
            try {
                await this.fetchUser();
                return this.isAuthenticated;
            } catch (e) {
                return false;
            }
        }
    }
});
