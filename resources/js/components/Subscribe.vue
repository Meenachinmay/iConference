<template>

    <button :class="classes" v-on:click="subscribe" >Subscribe</button>

</template>

<script>
    export default {

        props: ['active'],

        computed: {
            classes(){
                return ['btn bg-dark text-white rounded-pill', this.active ? 'disabled' : '']
            }
        },

        methods: {
            subscribe()
            {
                const requestType = this.active ? 'delete' : 'post';

                axios[requestType](location.pathname + '/subscriptions');

                this.active = ! this.active;
            }
        }
    }
</script>