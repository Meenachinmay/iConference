<template>

</template>
<script>

    import Replies from './Replies.vue'



    export default{

        props: ['firstRepliesCount'],
        components: { Replies },

        data() {

            return{
                repliesCount: this.firstRepliesCount,
            }

        }
    }

</script>