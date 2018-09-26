import * as types from './mutation_types'
import Vue from 'vue'

export default {

    [types.SET_USER](state, {list}) {
        localStorage.setItem('auth_token', list.token)
        localStorage.setItem('user', JSON.stringify(list.user))
        state.user = list.user
        state.token = list.token
        state.authenticated = true
    },
    [types.SET_FILMS](state, {list}) {
        state.films = list
    },
    [types.ERROR_MESSAGE](state, {list}) {
        state.error = list
    },
    [types.LOADING](state) {
        state.loading = !state.loading
    },
    [types.SET_CURRENT_FILM](state, {list}) {
        state.currentFilm = list
    },
    [types.LOGOUT_USER](state) {
        localStorage.removeItem('auth_token')
        localStorage.removeItem('user')
        state.user = {}
        state.authenticated = false
    },
    [types.SET_COMMENT](state, {list}) {
        let comments = state.currentFilm.comments
        comments.push(list)
        Vue.set(state.currentFilm, 'comments', comments)
    },
    [types.SET_TOKEN](state, {list}) {
        localStorage.setItem('auth_token', list)
        Vue.set(state, 'token', list)
    },
}
