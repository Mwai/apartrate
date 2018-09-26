<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card card-default p-3">
                    <form @submit.prevent="registerUser">
                        <div class="row">
                            <div class="col-sm-12">
                                <input required v-model="name" type="text" name="name"
                                       class="form-control" placeholder="Username">
                            </div>
                            <div class="col-sm-12 pt-2">
                                <input required v-model="email" type="email" name="email"
                                       class="form-control" placeholder="Email">
                            </div>
                            <div class="col-sm-12 pt-2">
                                <input required v-model="password" type="password" name="password"
                                       class="form-control"
                                       placeholder="Password">
                            </div>
                            <div class="col-sm-12 pt-2 text-center">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                name: '',
                email: '',
                password: ''
            }
        },
        methods: {
            registerUser() {
                let data = {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }
                this.$store.dispatch('registerUser', {data})
            }
        }
    }
</script>
