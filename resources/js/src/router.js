import Vue from 'vue'
import VueRouter from 'vue-router'
import Films from '../components/Films'
import Home from '../components/Home'
import FilmView from '../components/FilmView'
import CreateFilm from '../components/CreateFilm'

Vue.use(VueRouter)
Vue.component('Home', Home)
Vue.component(Films)
const routes = [
    {
        path: '/',
        redirect: { name: 'films' }
    },
    {
        path: '/to/films',
        redirect: { name: 'films' }
    },
    {
        path: '/films',
        name: 'films',
        component: Films,
        meta: {title: 'Films'}
    },
    {
        path: '/films/create',
        name: 'create-film',
        component: CreateFilm,
        meta: {title: 'Create Film'}
    },
    {
        path: '/films/:slug',
        name: 'film-details',
        component: FilmView,
        meta: {title: 'Film Details'},
        props: true
    },
]

export default new VueRouter({
    routes,
    mode: 'history',
    canReuse: false
})
