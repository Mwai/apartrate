
import Vue from 'vue'
import router from './src/router'
import store from './src/store'
import App from './components/App'

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
