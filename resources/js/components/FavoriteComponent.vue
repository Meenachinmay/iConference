<template>

    <button :class="classes" v-on:click="toggle">


        <i class="fa fa-1x fa-thumbs-up"></i>

        <span v-text="favoritesCount"></span>

    </button>

</template>

<script>

    export default {

        props: ['reply'],

        data: function () {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited // false if not liked and true id already liked by current user (nice ne)
            }
        },

        // button computed classes
        computed: {

            classes() {
                return ['btn btn-sm float-right', this.isFavorited ? 'btn-primary' : 'btn-light']
            },

            api_end_point() {
                return ('/replies/' + this.reply.id + '/favorites')
            }
        },

        methods: {

            // method to toggle like functionality
            toggle(){

                // if a reply is already liked by us then give it a dislike
                // other wise give it a like
                this.isFavorited ? this.dislike() : this.like()

            },

            // do like on a reply (for auth user)
            like(){

                // reply creating a like in favorite table ajax request to the server
                axios.post(this.api_end_point)

                this.isFavorited = true
                this.favoritesCount++

            },

            // dislike a reply ( for auth user)
            dislike(){

                // reply delete ajax request to the server
                axios.delete(this.api_end_point)

                this.isFavorited = false
                this.favoritesCount--

            }
        }

    }

</script>