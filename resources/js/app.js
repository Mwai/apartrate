import Vue from 'vue'
import router from './src/router'
import store from './src/store'
import App from './components/App'
import Pagination from 'laravel-vue-pagination'
import Avatar from 'vue-avatar'
import VeeValidate from 'vee-validate'
import Notifications from 'vue-notification'

Vue.use(VeeValidate)
Vue.component('pagination', Pagination);
Vue.component('avatar', Avatar);
Vue.use(Notifications)

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    next()
})

export const app = new Vue({
    router,
    store,
    template: '<App/>',
    components: {App},
}).$mount('#app')
