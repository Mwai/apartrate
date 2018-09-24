<template>
    <div>
        <div class="col-xs-12">
            <div class="col-xs-8 offset-xs-2 text-right">
                <router-link to="/films/create" class="btn btn-outline-info btn-sm">
                    Add new film
                </router-link>
            </div>
            <div class="card col-sm-12 mt-3">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Film Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Ticket Price</th>
                        <th scope="col">Country</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="film in getFilms.data">
                        <td>
                            <img width="50" :src="film.photo">
                        </td>
                        <td>
                            <router-link :to="'/films/' + film.slug">
                                {{film.name}}
                            </router-link>
                        </td>
                        <td>{{limitStr(film.description)}}</td>
                        <td>{{formatDate(film.release_date)}}</td>
                        <td>{{film.rating}}</td>
                        <td>$ {{film.ticket_price.toLocaleString()}}</td>
                        <td>{{film.country}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="row mt-5 justify-content-center">
                <pagination v-if="getFilms.data !== undefined && getFilms.data.length" :data="getFilms"
                            @pagination-change-page="getResults"/>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import moment from 'moment'

    export default {
        mounted() {
            this.getResults();
        },
        methods: {
            getResults(page = 1) {
                this.$store.dispatch('fetchFilms', {page})
            },
            limitStr(str) {
                return str.length > 20 ? str.substring(0, 20) + '...' : str;
            },
            formatDate(date) {
                return moment(date).format('LLLL')
            }

        },
        computed: {
            ...mapGetters([
                'getFilms'
            ])
        }
    }
</script>
