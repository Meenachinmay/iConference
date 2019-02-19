<template>

    <div class="card mb-4">

        <div class="card-header" style="background-color: #ffffff;">

            <div v-if="signedIn">

                <!-- liking and disliking functionality coming from vue js end.  -->
                <favorite-component :reply=" data "></favorite-component>

            </div>

            <a :href="'/profiles/' + data.owner.name" v-text="data.owner.name">
                    </a> commented on this <span v-text="ago"></span>

        </div>

        <!-- card for each thread -->
        <div class="card-body">

            <div v-if="seen">

                <div class="form-group">

                    <textarea class="form-control" v-model="body"></textarea>

                </div>

                <button class="btn btn-sm btn-primary" v-on:click="update">Update</button>

                <button class="btn btn-sm btn-link" v-on:click="seen = !seen">Cancel</button>

            </div>

            <div v-else v-text="body"></div>

        </div>

        <!-- card footer -->
        <!--@can('update', $reply)-->
        <div class="card-footer " v-if="canUpdate" style="background-color: #ffffff">

            <div class="row">

                <div v-if="canUpdate">

                    <!-- edit a reply -->
                    <button class="btn btn-sm btn-light" v-on:click="seen = !seen">Edit</button>

                    <!-- delete a reply -->
                    <button class="btn btn-sm btn-danger ml-2" @click="destroy">Delete</button>

                </div>

            </div>

        </div>

        <!--@endcan-->

    </div>

</template>
<script>

    // import here the other components
    import FavoriteComponent from './FavoriteComponent.vue'

    // import moment js
    import moment from 'moment'

    export default {
        props: ['data', 'authRequest'],

        components: {FavoriteComponent},
        data(){

            return{
                seen: false,
                id: this.data.id,
                body: this.data.body,
                //auth_ok: this.authRequest
            };
        },

        computed: {

          ago(){
              return moment(this.data.created_at).fromNow() + '...'
          },

          signedIn(){
              return window.App.signedIn
          },

            canUpdate(){

                return this.authorize(user => this.data.user_id == user.id)

          },

        },
        methods: {

            // update a reply with vuejs (no more refresh)
            update(){
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                })

                this.seen = false
            },

            destroy(){
                axios.delete('/replies/' + this.data.id)

                // emitting a event that i am deleted now do next thing
                this.$emit('deleted', this.data.id)

                // $(this.$el).fadeOut(600);
            },
        }
    }

</script>