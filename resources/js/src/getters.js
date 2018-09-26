export const getLoggedInUser = (state) => {
    return state.user
}
export const getFilms = (state) => {
    return state.films
}
export const getError = (state) => {
    return state.error
}
export const getLoader = (state) => {
    return state.loading
}
export const getCurrentFilm = (state) => {
    return state.currentFilm
}
export const checkAuthentication = (state) => {
    return state.authenticated
}
export const getToken = (state) => {
    return state.token
}
