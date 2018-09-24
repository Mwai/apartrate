import axios from 'axios'
import auth from './auth'
import moment from 'moment'
import store from './store'


if (localStorage.getItem('auth_token')) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token')
}
let instance = axios.create({
    baseURL: '/'
})

instance.interceptors.response.use((response) => {
    let token_expiry = store.state.token_expiry, current_date = moment().unix(),
        expiry_date = moment(token_expiry).unix()
    return response

    if (typeof token_expiry === 'undefined' || !token_expiry || current_date > expiry_date) {
        auth.logout()
    } else {
        return response
    }
}, function (error) {
    // Do something with response error
    if (error.response.status === 401) {
        auth.logout()
    }
})

export default instance
