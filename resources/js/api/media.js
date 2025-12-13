import apiClient from '@/plugins/axios';

export default {
    // Standard CRUD
    index(params) {
        return apiClient.get('/media', { params });
    },
    store(data) {
        return apiClient.post('/media', data);
    },
    show(id) {
        return apiClient.get(`/media/${id}`);
    },
    update(id, data) {
        return apiClient.put(`/media/${id}`, data);
    },
    destroy(id) {
        return apiClient.delete(`/media/${id}`);
    },

    // Custom Routes
    showUnknown(params) {
        return apiClient.get('/media/show-unknown', { params });
    },
    assignAsNewGroup(data) {
        return apiClient.post('/media/assign-as-new-group', data);
    },
    import(data) {
        // Assuming file upload, content-type multipart/form-data is usually handled automatically by axios if FormData is passed
        return apiClient.post('/media/import', data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }
};
