<template>

    <li class="nav-item dropdown" v-if="notifications.length">
        <a id="navbarDropdown" class="nav-link dropdown-toggle mr-3 px-1" href="#"
           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

            <span> <i class="fa fa-bell"></i> </span>

        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

            <div v-for="notification in notifications">

                <a class="dropdown-item" :href="notification.data.link"
                   v-text="notification.data.message" v-on:click="markAsRead(notification)"></a>

            </div>

        </div>

    </li>

</template>

<script>
    export default {
        data(){
            return {
                notifications: false
            }
        },

        // fetch all the notifications for user
        created() {
            axios.get("/profile/" + window.App.user.name +"/notifications")
                .then(response => this.notifications = response.data)
        },

        methods: {
            markAsRead(notification) {
                axios.delete("/profile/" + window.App.user.name +"/notifications/" + notification.id)
            },
        },
    }

</script>