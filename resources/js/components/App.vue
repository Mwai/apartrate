<template>
    <div class="container">
        <nav class="navbar navbar-light bg-white fixed-top">
            <router-link to="/" class="navbar-brand">Generic Films</router-link>
            <div v-if="checkAuthentication">
                <a href="#" @click="logoutUser">
                    <avatar :size="40" :username="getLoggedInUser.name"/>
                    Logout
                </a>
            </div>
        </nav>
        <div class="row justify-content-center mt-5">
            <div class="lds-dual-ring" v-if="getLoader"></div>
            <router-view :key="$route.fullPath" class="view col-sm-12"/>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        computed: {
            ...mapGetters([
                'getLoader',
                'getLoggedInUser',
                'checkAuthentication'
            ])
        },
        methods: {
            logoutUser() {
                this.$store.dispatch('logoutUser')

            }
        }
    }
</script>
