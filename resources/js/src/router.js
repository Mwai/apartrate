import Vue from 'vue'
import VueRouter from 'vue-router'
import Films from '../components/Films'
import Home from '../components/Home'

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
]

export default new VueRouter({
    routes,
    mode: 'history',
    canReuse: false
})
