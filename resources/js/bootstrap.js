import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Axios security configuration
// window.axios.defaults.withCredentials = true; // Enable cookies for CORS requests
// window.axios.defaults.timeout = 30000; // 30 seconds timeout to prevent hanging requests

// // Prevent storing sensitive data in browser history
// window.axios.defaults.headers.common['Cache-Control'] = 'no-cache, no-store, must-revalidate';
// window.axios.defaults.headers.common['Pragma'] = 'no-cache';

// // Response interceptor for global error handling
// window.axios.interceptors.response.use(
//     response => response,
//     error => {
//         if (error.response?.status === 419) {
//             // CSRF token mismatch
//             console.error('CSRF token mismatch. Please refresh the page.');
//         } else if (error.response?.status === 401) {
//             // Unauthorized - redirect to login
//             window.location.href = '/login';
//         }
//         return Promise.reject(error);
//     }
// );
