<template>

    <section class="p-2">
        <div class="p-3">
            <i class="greenIcon mx-auto fa-3x fa-solid fa-message"></i>
            <h1 class="mt-2">Mes notifications</h1>
        </div>

        <h2 class="mb-5 fs-5" v-if="notifications.length > 0">{{ notifications.length }} notifications dont {{
                notifications.filter(n => !n.lue).length
        }} non lues</h2>

        <div class="container my-2" v-if="notifications.length > 0" v-for="notification in notifications">

            <!-- <div class="row py-4 border border-secondary" @click="showFullMessage = !showFullMessage">

               <p class="text-dark">{{ moment(notification.created_at).format("ddd DD MMM YYYY [à]HH:mm") }}</p> -->
            <!-- <h2 class="fs-3">{{ notification.titre }}</h2>
                <p v-if="showFullMessage" v-html="notification.message"></p>
            </div> -->

            <div class="accordion" :id="`notification${notification.id}`">
                <div class="accordion-item">

                    <div class="accordion-header text-white"
                        id="headingOne">
                        <button @click="markNotificationAsRead(notification.id)" class="accordion-button row" type="button" data-bs-toggle="collapse"
                            :data-bs-target="`#message${notification.id}`" aria-expanded="false"
                            :aria-controls="`message${notification.id}`">

                            <p class="text-white col-lg-4">postée le {{ notification.created_at.substring(0, 10) }}</p>

                            <h3 class="col-lg-6">{{ notification.titre }}</h3>

                            <div v-if="!notification.lue" class="text-white col-lg-2"><i
                                    class="fa-solid fa-2x fa-circle-exclamation text-danger me-2"></i>Non lue</div>
                        </button>
                    </div>

                    <div :id="`message${notification.id}`" class="accordion-collapse collapse"
                        aria-labelledby="headingOne" :data-bs-parent="`#notification${notification.id}`">
                        <div class="accordion-body">
                            <p class="ms-3 ms-md-5 text-start" v-html="notification.message"></p>
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
import { store } from "../store"
import moment from 'moment';
moment.locale('fr');

export default {
    computed: {
        notifications() {
            return store.state.notifications
        }
    },

    data() {
        return {
            showFullMessage: false
        }
    },

    methods: {
        getNotifications() {
            console.log("récupération des notifications")
            axios.get('/api/notifications/' + store.state.userData.id)
                .then(response => {
                    console.log(response.data)
                    store.commit('storeNotifications', response.data);
                    console.log(store.state.notifications)
                }).catch((response) => {
                    console.log(response.error);
                })
        },

        markNotificationAsRead(notificationId) {
            axios.put('/api/notifications/' + notificationId)
                .then(() => this.$router.push('/mesnotifications'))
                .catch((response) => {
                    console.log(response.error);
                })
        }
    },

    created() {

        if (!this.notifications) {
            this.getNotifications()
        }

        console.log(this.notifications)
    }
}
</script>

<style scoped>
.greenIcon {
    color: #94DEB1
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

.placeName {
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
</style>