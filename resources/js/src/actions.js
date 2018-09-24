import * as types from './mutation_types'
import request from './request'

export const loginUser = ({commit}, {data}) => {
    request.post('/api/login/', data)
        .then(() => {
            return true
        })
        .catch(error => {
            let errorMessage = error.request + ':Error Logging in'
            commit(types.ERROR_MESSAGE, errorMessage)
            console.log(error)
        })
}
export const fetchFilms = ({commit}, {page}) => {
    commit(types.LOADING)
    request.get('/api/films?page=' + page).then((response) => {
        commit(types.SET_FILMS, {list: response.data.data})
        commit(types.LOADING)
    }).catch(error => {
        let errorMessage = error.request + ':Error loading films'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
        console.log(error)
    })
}
