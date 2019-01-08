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
        <notifications group="alerts" position="top left"></notifications>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import * as types from '../src/mutation_types'

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

            },
            errorNotification: function (error) {
                this.$notify({
                    group: 'alerts',
                    title: 'Error!',
                    text: error,
                    type: 'error',
                    duration: 10000
                });
                this.$store.commit(types.LOADING, false)
            }
        },
        watch: {
            '$store.state.error': function (newError) {
                let instance = this
                if (typeof newError === 'string') {
                    instance.errorNotification(newError)

                } else {
                    Object.keys(newError).forEach(function (key) {
                        instance.errorNotification(newError[key][0])
                    });
                }
            }
        }
    }
</script>
