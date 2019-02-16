<template>

    <div class="mt-3">

        <div v-for="(reply, index) in items" :key="reply.id">

            <reply :authRequest="userAuthData" :data="reply" @deleted="remove(index)"></reply>

        </div>

        <pagination :dataSet="dataSet" @pageChanged="fetch"></pagination>

        <new-reply :endpoint="endpoint" @created="add"></new-reply>

    </div>

</template>

<script>

    import Reply from './Reply.vue'
    import NewReply from './NewReply.vue'
    import Collection from '../mixins/Collection'

    export default {

        props: ['authOk'],
        components: { Reply, NewReply },

        // adding mixing (basically extracting the methods to some other class to make code more organized and clean)
        mixins: [Collection],

        data() {

            return {
                dataSet: false,

                items: [],

                userAuthData: this.authOk,

                endpoint: location.pathname + '/replies',

                repliesFetchingEndPoint: location.pathname + '/replies',
            }

        },

        created(){

            this.fetch()
        },

        methods: {

            fetch(page){
                // posting a ajax request
                axios.get(this.url(page))
                    .then(this.refresh)
            },

            refresh({data}){
                this.dataSet = data
                this.items = data.data
            },

            url(page){

                if (!page){

                    const query = location.search.match(/page=(\d+)/)

                    page = query ? query[1] : 1
                }

                return location.pathname + '/replies?page=' + page
            }

        }
    }

</script>