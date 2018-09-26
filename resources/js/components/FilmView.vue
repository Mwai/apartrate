<template>
    <div class="row">
        <div v-if="Object.keys(film).length < 1" class="col-sm-12 text-center">
            <p>Film not found</p>
        </div>
        <div v-else class="col-sm-12">
            <div class="card p-2">
                <div class="row justify-content-center">
                    <div class="col col-sm-4">
                        <img class="float-right" width="350" :src="film.photo">
                    </div>
                    <div class="col col-sm-5">
                        <h3>
                            {{film.name}}
                            <span class="text-info">
                        <small>
                            <i class="fas fa-star"></i>
                            <span>{{film.rating}}.0</span>
                        </small>
                    </span>
                        </h3>
                        <p>
                            {{film.description}}
                        </p>
                        <div class="justify-content-center row">
                            <div class="col col-sm-4">
                                <p class="mb-0">
                                    <small>Price</small>
                                </p>
                                <p>
                                    <i class="fas fa-money-bill-alt"></i>
                                    <small>$ {{film.ticket_price.toLocaleString()}}</small>
                                </p>
                            </div>
                            <div class="col col-sm-4">
                                <p class="mb-0">
                                    <small>Country</small>
                                </p>
                                <p>
                                    <i class="fas fa-globe-africa"></i>
                                    <small>{{film.country}}</small>
                                </p>
                            </div>
                            <div class="col col-sm-4">
                                <p class="mb-0">
                                    <small>Release Date</small>
                                </p>
                                <p>
                                    <i class="fas fa-calendar-check"></i>
                                    <small>{{formatDate(film.release_date)}}</small>
                                </p>
                            </div>
                            <div class="col col-sm-12">
                                <p class="mb-0">
                                    <small>Genre</small>
                                </p>
                                <span v-for="genre in film.genres" class="badge badge-pill badge-secondary">
                            {{genre.name}}
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5 text-center">
                    <p class="font-weight-bold">Comments</p>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div v-for="comment in film.comments" class="card col-sm-7 mb-2">
                    <div class="row justify-content-start p-2">
                        <div class="col-2 text-center pt-2">
                            <avatar inline :size="40" :username="comment.user.name"/>
                            <p class="font-weight-light mb-0 pt-1">
                                <small>{{comment.user.name}}</small>
                            </p>
                        </div>
                        <div class="col-10">
                            <p>
                                {{comment.comment}}
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-right mb-0 font-weight-light">
                                <small>{{formatCommentDate(comment.created_at)}}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-6 mt-3">
                    <div class="col-sm-12" v-if="checkAuthentication">
                        <Comment v-bind:filmId="film.id"/>
                    </div>
                    <div v-else class="col-sm-12">
                        <div class="col-sm-12 text-center">
                            <p>
                                Login or Sign up to post a comment.
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <button class="btn btn-outline-primary btn-sm" @click="setActionCard('login')">Login
                                </button>
                            </div>
                            <div class="col-sm-6 text-center">
                                <button class="btn btn-outline-success btn-sm" @click="setActionCard('register')">Sign
                                    up
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <transition>
                                <Login v-if="action === 'login'" key="login"/>
                                <Register v-if="action === 'register'" key="register"/>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'
    import moment from 'moment'
    import Login from './Login'
    import Register from './Register'
    import Comment from './Comment'

    export default {
        props: {
            slug: {
                type: String,
            }
        },
        components: {
            Login,
            Register,
            Comment
        },
        data() {
            return {
                action: ''
            }
        },
        mounted() {
            this.getFilm(this.slug)
        },
        methods: {
            getFilm(slug) {
                this.$store.dispatch('fetchFilmFromSlug', {slug})
            },
            formatDate(date) {
                return moment(date).format('LLLL')
            },
            formatCommentDate(date) {
                return moment(date).fromNow()
            },
            setActionCard(action) {
                this.action = action
            }
        },
        computed: {
            ...mapGetters([
                'getCurrentFilm',
                'checkAuthentication'
            ]),
            film: function () {
                return this.getCurrentFilm
            }
        }
    }
</script>
