<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card card-default p-3">
                    <form @submit.prevent="loginUser">
                        <div class="row">
                            <div class="col-sm-12">
                                <input required v-model="email" type="email" name="email"
                                       class="form-control" placeholder="Email">
                            </div>
                            <div class="col-sm-12 pt-2">
                                <input required v-model="password" type="password" name="password"
                                       class="form-control"
                                       placeholder="password">
                            </div>
                            <div class="col-sm-12 pt-2 text-center">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Login</button>
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
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            loginUser() {
                let data = {
                    email: this.email,
                    password: this.password
                };
                this.$store.dispatch('loginUser', {data})

            }
        }
    }
</script>
