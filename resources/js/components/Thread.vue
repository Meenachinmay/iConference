<template>

</template>
<script>

    import Replies from './Replies.vue'
    import Subscribe from './Subscribe.vue'

    export default{

        props: ['firstRepliesCount'],
        components: { Replies, Subscribe},

        data() {

            return{
                repliesCount: this.firstRepliesCount,
            }

        }
    }

</script>