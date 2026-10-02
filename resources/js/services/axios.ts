import axios from 'axios';
import router from '../router';

const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL || '/api',
    timeout: 30000,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    },
    withCredentials: true,
});

api.interceptors.response.use(
    (response) => response,
    (error) => {
        // if (error.response && error.response.status === 401) {
        //     router.push('/'); 
        // }
        
        return Promise.reject(error);
    }
);

export default api;