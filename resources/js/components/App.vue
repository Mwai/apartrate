<template>
    <div class="container">
        <div class="row justify-content-center">
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
                'getLoader'
            ])
        }
    }
</script>
