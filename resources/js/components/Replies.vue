<template>

    <div>

        <div v-for="(reply, index) in items">

            <reply :authRequest="userAuthData" :data="reply" @deleted="remove(index)"></reply>

        </div>

    </div>

</template>

<script>

    import Reply from './Reply.vue'

    export default {

        props: ['data', 'authOk'],
        components: { Reply },

        data() {

            return {
                items: this.data,
                userAuthData: this.authOk
            }

        },

        methods: {

            remove(index) {

                this.items.splice(index, 1)

                this.$emit('removed')
            }
        }
    }

</script>