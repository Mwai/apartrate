import * as types from './mutation_types'

export default {

    [types.SET_USER](state, {list}) {
        state.user = list
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
}
