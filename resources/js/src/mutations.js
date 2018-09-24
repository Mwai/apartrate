import * as types from './mutation_types'

export default {

    [types.SET_USER](state, {list}) {
        state.user = list
    },
}
