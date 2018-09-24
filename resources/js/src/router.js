import Vue from 'vue'
import VueRouter from 'vue-router'
import Films from '../components/Films'
import Home from '../components/Home'
import FilmView from '../components/FilmView'

Vue.use(VueRouter)
Vue.component('Home', Home)
Vue.component(Films)
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {title: 'Home'}
    },
    {
        path: '/films',
        name: 'films',
        component: Films,
        meta: {title: 'Films'}
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
