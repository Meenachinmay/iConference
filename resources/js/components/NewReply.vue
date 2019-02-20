<template>

    <div v-if="signedIn">

        <!-- reply box -->
        <div class="card mt-4">

            <!-- replies card header -->
            <div class="card-header" style="background-color: #ffffff">Leave a reply</div>

            <div class="card-body">

                    <div class="form-group">

                        <textarea name="body" id="body"
                                  cols="6"
                                  rows="3"
                                  class="form-control"
                                  v-model="body"
                                  placeholder="Have something to say..." required>

                        </textarea>

                    </div>

                    <div class="form-group">
                        <button class="btn btn-sm btn-success rounded-pill" type="submit" v-on:click="addReply"> Post a reply </button>
                    </div>

            </div>

        </div>

    </div>

    <div v-else>

        <div class="row justify-content-center mt-5">

            <div class="col-md-8">
                <p>Please <a href="/login">sign in</a> to participate in this discussion</p>
            </div>

        </div>

    </div>

</template>


<script>

    export default {

        props: ['endpoint'],
        data(){
            return {
                body: '',
            }
        },

        computed: {

            signedIn(){
                return window.App.signedIn
            }
        },

        methods: {
            addReply(){
                axios.post(this.endpoint, {body: this.body})
                    .then(response => {
                        this.body = ''


                        // make a flash here later
                        this.$emit('created', response.data)
                    })
            }
        }
    }

</script>