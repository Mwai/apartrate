import axios from 'axios'
import store from './store'
import * as types from "./mutation_types";

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
}, errorResponseHandler)

function errorResponseHandler(error) {
    checkResponseToken(error.response)
    // Do something with response error
    store.commit(types.ERROR_MESSAGE, error.response.data.message)
    if (error.response.status === 401) {
        store.actions.logoutUser()
    }
}

export const checkResponseToken = (response) => {
    const newToken = response.headers.authorization
    if (newToken) {
        let token = newToken.replace(/Bearer/g, '')
        store.commit('SET_TOKEN', token)
    }
}

export default instance
