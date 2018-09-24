<template>
    <div class="container">
        <div class="row justify-content-center">
            <router-view :key="$route.fullPath" class="view"/>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
