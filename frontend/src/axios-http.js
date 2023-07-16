import axios from "axios";
// import { manageCookies } from '@/store/cookie.js';
const axiosClient = axios.create({
    baseURL: process.env.VUE_APP_API_URL,
});
// axiosClient.interceptors.request.use((config)=>{
//     // const authStore = manageCookies();
//     // const token = authStore.getToken();
//     config.headers.Authorization = "Bearer" + token;
//     config.headers.Accept = "application/json";
//     return config;
// })

export default axiosClient;