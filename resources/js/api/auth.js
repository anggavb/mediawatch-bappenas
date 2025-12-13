import apiClient from '@/plugins/axios';

export default {
    register(data) {
        return apiClient.post('/auth/register', data);
    },
    login(data) {
        return apiClient.post('/auth/login', data);
    },
    logout() {
        return apiClient.post('/auth/logout');
    },
    me() {
        return apiClient.get('/auth/user');
    }
};
