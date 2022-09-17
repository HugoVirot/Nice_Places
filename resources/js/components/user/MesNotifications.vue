<template>

    <section class="p-2">
        <div class="p-3">
            <i class="greenIcon mx-auto fa-3x fa-solid fa-message"></i>
            <h1 class="mt-2">Mes notifications</h1>
        </div>

        <div class="container">
            <div class="row p-2">
                <div v-if="notifications.length > 0"
                    class="greenIcon mx-auto my-5 border border-4 rounded border-secondary col-md-4 offset-md-1 py-5">
                    <i class="fa-5x fa-solid fa-envelope mb-3"></i>
                    <p><span class="fs-1">{{  notifications.length  }}</span> notification(s) reçues au total</p>
                </div>

                <div v-show="notifications.length > 0 && countUnreadNotifications > 0"
                    class="mx-auto my-5 text-danger border border-4 rounded border-danger col-md-4 offset-md-1 py-5">
                    <i class="fa-5x fa-solid fa-bell mb-3"></i>
                    <p><span class="fs-1">{{  countUnreadNotifications  }}</span> non lues </p>
                </div>
            </div>
        </div>

        <div v-if="showNotificationReadMessage">
            <p class="text-white greenBackground rounded mx-auto w-25 p-3">Notification marquée comme lue</p>
            <button class="btn greenBackground" @click="showNotificationReadMessage = false">OK</button>
        </div>

        <div class="container my-2" v-if="notifications.length > 0" v-for="notification in notifications">


            <!-- <p class="text-dark">{{ moment(notification.created_at).format("ddd DD MMM YYYY [à]HH:mm") }}</p> -->

            <div class="accordion" :id="`notification${notification.id}`">
                <div class="accordion-item">

                    <div class="accordion-header text-white" id="headingOne">
                        <button class="accordion-button mx-auto row" type="button" data-bs-toggle="collapse"
                            :data-bs-target="`#message${notification.id}`" aria-expanded="false"
                            :aria-controls="`message${notification.id}`">

                            <p class="text-white col-lg-3">reçue le {{  notification.created_at.substring(0, 10)  }}</p>

                            <h3 class="col-lg-7">{{  notification.titre  }}</h3>

                            <div v-if="!notification.lue" class="text-white col-lg-2"><i
                                    class="fa-solid fa-2x fa-circle-exclamation text-danger me-2"></i>Non lue</div>
                        </button>
                    </div>

                    <div :id="`message${notification.id}`" class="accordion-collapse collapse"
                        aria-labelledby="headingOne" :data-bs-parent="`#notification${notification.id}`">
                        <div class="accordion-body">
                            <p class="text-center notificationMessage" v-html="notification.message"></p>
                            <button v-if="!notification.lue" class="btn btn-info mx-auto"
                                @click="markNotificationAsRead(notification.id)">OK (marquer comme lue)</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div v-else>
            <p>Vous n'avez aucune notification.</p>
        </div>
    </section>
</template>

<script>
import { store } from "../../store"
import moment from 'moment';
moment.locale('fr');

export default {
    computed: {
        notifications() {
            return store.state.notifications
        },
        countUnreadNotifications() {
            if (store.state.notifications) {
                return store.state.notifications.filter(n => !n.lue).length
            } else {
                return null
            }
        }
    },

    data() {
        return {
            showFullMessage: false,
            showNotificationReadMessage: false
        }
    },

    methods: {
        getNotifications() {
            axios.get('/api/getnotificationsbyuser/' + store.state.userData.id)
                .then(response => {
                    console.log(response.data)
                    store.commit('storeNotifications', response.data);
                }).catch((response) => {
                    console.log(response.error);
                })
        },

        markNotificationAsRead(notificationId) {
            axios.put('/api/notifications/' + notificationId)
                .then(response => {
                    this.showNotificationReadMessage = true
                    this.getNotifications()
                    this.$router.push('/mesnotifications')
                })
                .catch((response) => {
                    console.log(response.error);
                })
        }
    },

    created() {
        console.log("je passe dans created")
        this.getNotifications()
    }
}
</script>

<style scoped>
.greenIcon {
    color: #94DEB1
}

.greenBackground {
    background-color: #94DEB1;
}

h1 {
    color: #1C6E8C
}

h3 {
    color: white
}

p {
    color: grey
}

.accordion-button {
    background-color: #1C6E8C;
}

.textWithShadow {
    text-shadow: 2px 2px 4px #1C6E8C;
}

.card {
    height: 35vh
}

button {
    background-color: #1C6E8C;
    color: white
}

button:hover {
    background-color: #94DEB1;
    color: white
}

.notificationMessage {
    line-height: 3em;
    color: black
}
</style>