<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card card-default p-3">
                    <form @submit.prevent="postComment">
                        <div class="form-group">
                            <textarea v-model="comment" required class="form-control col-sm-12" id="commentText"
                                      rows="3"
                                      placeholder="Non-offensive comment here..."></textarea>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-outline-primary btn-sm float-right">Post Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        props: ['filmId'],
        data() {
            return {
                comment: ''
            }
        },
        methods: {
            postComment() {
                let data = {
                    film_id: this.filmId,
                    comment: this.comment
                };
                this.$store.dispatch('postComment', {data})

            }
        },
        computed: {
            ...mapGetters([
                'getToken'
            ])
        }
    }
</script>
