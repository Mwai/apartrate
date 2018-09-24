import Vue from 'vue'
import Vuex from 'vuex'
import * as getters from './getters'
import * as actions from './actions'
import mutations from './mutations'

Vue.use(Vuex)
let jwt = localStorage.getItem('auth_token'),
    user = localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : {},
    token_expiry = localStorage.getItem('token_expiry') ? localStorage.getItem('token_expiry') : null

const state = {
    user: user,
    token_expiry: token_expiry,
    loading: false,
    authenticated: !!jwt,
    films: [],
    error: false
}
export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})
