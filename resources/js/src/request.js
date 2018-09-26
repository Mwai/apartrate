import axios from 'axios'
import auth from './auth'
import store from './store'

let instance = axios.create({
    baseURL: '/'
})
instance.interceptors.request.use(
    (config) => {
        let token = localStorage.getItem('auth_token');

        if (token) {
            config.headers['Authorization'] = 'Bearer ' + token
        }

        return config;
    }
);
instance.interceptors.response.use((response) => {
    checkResponseToken(response)
    return response
}, function (error) {
    checkResponseToken(error.response)
    // Do something with response error
    if (error.response.status === 401) {
        auth.logout()
    }
})

export const checkResponseToken = (response) => {
    const newToken = response.headers.authorization
    if (newToken) {
        let token = newToken.replace(/Bearer/g, '')
        store.commit('SET_TOKEN', token)
    }
}

export default instance
