import apiClient from '@/plugins/axios';

export default {
    index(params) {
        return apiClient.get('/media-group', { params });
    },
    store(data) {
        return apiClient.post('/media-group', data);
    },
    show(id) {
        return apiClient.get(`/media-group/${id}`);
    },
    update(id, data) {
        return apiClient.put(`/media-group/${id}`, data);
    },
    destroy(id) {
        return apiClient.delete(`/media-group/${id}`);
    }
};
