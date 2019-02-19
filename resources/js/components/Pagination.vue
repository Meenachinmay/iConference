<template>

    <!-- adding pagination to the replies -->
    <nav aria-label="Page navigation example">

        <ul class="pagination" v-if="needPagination">

            <li class="page-item" v-show="prevLinkToGoTo"><a class="page-link" href="#" v-on:click.prevent="page--">Previous Page</a></li>

            <li class="page-item" v-show="nextLinkToGoTo"><a class="page-link" href="#" v-on:click.prevent="page++">Next Page</a></li>

        </ul>

    </nav>

</template>


<script>

    export default {
        props: ['dataSet'],

        data() {

            return {
                page: 1,
                prevLinkToGoTo: false,
                nextLinkToGoTo: false
            }

        },

        watch: {

          dataSet() {
              this.page = this.dataSet.current_page
              this.prevLinkToGoTo = this.dataSet.prev_page_url
              this.nextLinkToGoTo = this.dataSet.next_page_url
          },

          page(){

              this.pageUpdatedGetNewData()
          }
        },

        methods: {

            pageUpdatedGetNewData(){
                this.$emit('pageChanged', this.page)
            }

        },

        computed: {
            needPagination (){
                return !! this.prevLinkToGoTo || !! this.nextLinkToGoTo
            }
        },
    }

</script>