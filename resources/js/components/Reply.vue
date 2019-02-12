<template>

</template>
<script>

    export default {
        props: ['attributes'],
        data(){

            return{
                seen: false,
                body: this.attributes.body
            };
        },
        methods: {

            // update a reply with vuejs (no more refresh)
            update(){
                axios.patch('/replies/' + this.attributes.id, {
                    body: this.body
                })

                this.seen = false
            },

            update_(){
                axios.delete('/replies/' + this.attributes.id)

                $(this.$el).fadeOut(600);
            },
        }
    }

</script>