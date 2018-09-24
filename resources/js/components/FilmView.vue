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
                <div v-for="comment in film.comments" class="card col-sm-7">
                    <div class="row justify-content-start p-2">
                        <div class="col text-center pt-2">
                        <span class="avatar">
                            {{limitStr(comment.user.name)}}
                        </span>
                            <p class="font-weight-light mb-0 pt-1">
                                <small>{{comment.user.name}}</small>
                            </p>
                        </div>
                        <div class="col-10">
                            <p>
                                {{comment.comment}}
                            </p>
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

    export default {
        props: {
            slug: {
                type: String,
            }
        },
        mounted() {
            this.getFilm(this.slug)
        },
        methods: {
            getFilm(slug) {
                this.$store.dispatch('fetchFilmFromSlug', {slug})
            },
            limitStr(str) {
                return str.length > 1 ? str.substring(0, 1) : str;
            },
            formatDate(date){
                return moment(date).format('LLLL')
            }

        },
        computed: {
            ...mapGetters([
                'getCurrentFilm'
            ]),
            film: function () {
                return this.getCurrentFilm
            }
        }
    }
</script>
