import apiClient from '@/plugins/axios';

export default {
    // Standard CRUD
    index(params) {
        return apiClient.get('/medmon', { params });
    },
    store(data) {
        return apiClient.post('/medmon', data);
    },
    show(id) {
        return apiClient.get(`/medmon/${id}`);
    },
    update(id, data) {
        return apiClient.put(`/medmon/${id}`, data);
    },
    destroy(id) {
        return apiClient.delete(`/medmon/${id}`);
    },

    // Custom Routes
    search(data) {
        return apiClient.post('/medmon/search', data);
    },
    getAdditionalCategory() {
        return apiClient.get('/medmon/additional-category');
    },
    import(data) {
         // Assuming file upload
         return apiClient.post('/medmon/import', data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    },
    groupByCategory() {
        return apiClient.get('/medmon/group-by-category');
    }
};
