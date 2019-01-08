<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="card card-default p-3">
                    <div class="card-body">
                        <h5 class="card-title">Add new film</h5>
                        <form @submit.prevent="createFilm" novalidate>
                            <div class="form-group">
                                <label for="filmName">Film Name</label>
                                <input v-validate="'required'" data-vv-validate-on="change|blur" v-model="data.name"
                                       type="text" class="form-control" id="filmName"
                                       placeholder="Enter Name" name="name">
                                <span v-show="errors.has('name')" class="text-danger font-weight-light">
                                    {{ errors.first('name') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="filmDescription">Film Description</label>
                                <textarea v-validate="'required'" data-vv-validate-on="change|blur"
                                          v-model="data.description"
                                          class="form-control col-sm-12" id="filmDescription"
                                          rows="3"
                                          placeholder="description here..." name="description"></textarea>
                                <span v-show="errors.has('description')" class="text-danger font-weight-light">
                                    {{ errors.first('description') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="releaseDate">Release Date</label>
                                <input v-model="release_date" v-validate="'required'" data-vv-validate-on="change|blur"
                                       type="date"
                                       class="form-control" id="releaseDate"
                                       placeholder="Enter Name" @change="formatDate" name="release-date">
                                <span v-show="errors.has('release-date')" class="text-danger font-weight-light ">
                                    {{ errors.first('release-date') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <input v-validate="'required|min_value:1|max_value:5'" data-vv-validate-on="change|blur"
                                       v-model="data.rating" type="number" class="form-control" id="rating"
                                       placeholder="Enter rating" min="1" max="5" name="rating">
                                <span v-show="errors.has('rating')" class="text-danger font-weight-light">
                                    {{ errors.first('rating') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ticketPrice">Ticket Price</label>
                                <input v-validate="'required'" data-vv-validate-on="change|blur"
                                       v-model="data.ticket_price" type="number" class="form-control"
                                       id="ticketPrice" placeholder="Enter ticket price" name="price">
                                <span v-show="errors.has('price')" class="text-danger font-weight-light">
                                    {{ errors.first('price') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="filmGenres">Film Genres</label>
                                <v-select v-validate="'required'" data-vv-validate-on="change|blur" multiple
                                          id="filmGenres" v-model="data.genres" :options="allGenres" name="genres"/>
                                <span v-show="errors.has('genres')" class="text-danger font-weight-light">
                                    {{ errors.first('genres') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <v-select v-validate="'required'" id="country" name="country" v-model="data.country"
                                          :options="allCountries"/>
                                <span v-show="errors.has('country')" class="text-danger font-weight-light">
                                    {{ errors.first('country') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="filmPoster">Film poster</label>
                                <input v-validate="'required'" data-vv-validate-on="change|blur" type="file"
                                       class="form-control"
                                       id="filmPoster" ref="file" v-on:change="handleFileChange()" name="photo">
                                <span v-show="errors.has('photo')" class="text-danger font-weight-light">
                                    {{ errors.first('photo') }}
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Film</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import DatePicker from 'vuejs-datepicker'
    import VueSelect from 'vue-select'
    import moment from 'moment'

    export default {
        components: {
            'datepicker': DatePicker,
            'v-select': VueSelect
        },
        data() {
            return {
                data: {
                    name: '',
                    description: '',
                    release_date: '',
                    rating: '',
                    ticket_price: '',
                    country: '',
                    genres: []
                },
                photo: '',
                release_date: '',
                genres: []

            }
        },
        mounted() {
            this.$store.dispatch('fetchGenres')
        },
        methods: {
            createFilm: function () {
                this.$validator.validate().then(result => {
                    if (result) {
                        let data = this.data,
                            formData = new FormData()
                        formData.append('photo', this.photo);

                        for (let key in data) {
                            if (key === 'country') {
                                formData.append(key, data[key].value);
                            } else if (key === 'genres') {
                                let genresArray = []
                                data[key].forEach(function (e) {
                                    genresArray.push(e.value)
                                    formData.append(key, JSON.stringify(genresArray))
                                })
                            } else {
                                formData.append(key, data[key]);
                            }
                        }
                        this.$store.dispatch('postFilm', formData)
                    }
                });
            },
            handleFileChange: function () {
                this.photo = this.$refs.file.files[0]
            },
            formatDate: function () {
                this.data.release_date = moment.utc(this.release_date).format('YYYY-MM-DD')
            },
            formatGenreData: function () {
                let genres = []
                this.genres.forEach(function (genre) {
                    genres.push(genre.value)
                })
                this.data.genres = genres
            }
        },
        computed: {
            ...mapGetters([
                'getToken',
                'allGenres',
                'allCountries'
            ])
        }
    }
</script>
