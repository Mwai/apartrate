import * as types from './mutation_types'
import request from './request'
import router from "./router";

export const loginUser = ({commit}, {data}) => {
    commit(types.LOADING)
    request.post('/api/login/', data).then((response) => {
        commit(types.SET_USER, {list: response.data})
        commit(types.LOADING)
    }).catch(error => {
        let errorMessage = error.request + ':Error on login'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
        console.log(error)
    })
}
export const logoutUser = ({commit}) => {
    commit(types.LOADING)
    let data = {
        token: localStorage.getItem('auth_token')
    }
    request.post('/api/logout/', data).then(() => {
        commit(types.LOGOUT_USER)
        commit(types.LOADING)
    }).catch(error => {
        let errorMessage = error.request + ':Error on logout'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
        console.log(error)
    })
}
export const registerUser = ({commit}, {data}) => {
    commit(types.LOADING)
    request.post('/api/register/', data).then((response) => {
        commit(types.SET_USER, {list: response.data})
        commit(types.LOADING)
    }).catch(error => {
        let errorMessage = error.request + ':Error on registration'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
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
export const fetchFilmFromSlug = ({commit}, {slug}) => {
    commit(types.LOADING)
    request.get('/api/films/' + slug).then((response) => {
        commit(types.SET_CURRENT_FILM, {list: response.data.data})
        commit(types.LOADING)
    }).catch(error => {
        let errorMessage = error.request + ':Error loading film'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
        console.log(error)
    })
}
export const postComment = ({commit}, {data}) => {
    commit(types.LOADING)
    request.post('/api/comment/', data).then((response) => {
        commit(types.SET_COMMENT, {list: response.data.data})
        commit(types.LOADING)
    }).catch(error => {
        let errorMessage = error.request + ':Could not post comment'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
        console.log(error)
    })
}
export const fetchGenres = ({commit}) => {
    commit(types.LOADING)
    request.get('/api/genres/').then((response) => {
        let results = response.data.data,
            genres = []
        results.forEach(function (genre) {
            genres.push({
                label: genre.name,
                value: genre.id
            })
        })
        commit(types.SET_GENRES, {list: genres})
        request.get('https://restcountries.eu/rest/v1/all').then(function (response) {
            let results = response.data,
                countries = []
            results.forEach(function (country) {
                countries.push({
                    label: country.name,
                    value: country.name
                })
            })
            commit(types.SET_COUNTRIES, {list: countries})
            commit(types.LOADING)
        })
    }).catch(error => {
        let errorMessage = error.request + ':Could not fetch genres'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
        console.log(error)
    })
}
export const postFilm = ({commit}, {data}) => {
    commit(types.LOADING)
    console.log(data)
    request.post('/api/films/', data).then((response) => {
        let film = response.data.data
        commit(types.LOADING)
        router.push('/films/' + film.slug)
    }).catch(error => {
        let errorMessage = error.request + ':Could not post comment'
        commit(types.ERROR_MESSAGE, errorMessage)
        commit(types.LOADING)
        console.log(error)
    })
}
