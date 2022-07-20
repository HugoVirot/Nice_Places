<script>
import { store } from "../store";

export default {

    computed: {
        userPlaces() {
            return store.state.userPlaces
        }
    },

    methods: {
        // on récupère les lieux postes par le user

        getLieuxPostes() {
            axios.post("http://localhost:8000/api/lieus/getplacesbyuser", null, {
                params: {
                    user_id: store.state.userData.id
                }
            })
                .then(response => {
                    store.commit('storeUserPlaces', response.data)
                    console.log(this.userPlaces)
                }
                )
                .catch(error => {
                    console.log(error.response)
                })
        },
    },

    created() {
        this.getLieuxPostes()
    }
}
</script>

<template>

    <div class="pt-5 pb-2">
        <i class="mx-auto fa-3x fa-solid fa-paper-plane"></i>
        <h1 class="mt-2">Mes lieux postés</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">
        <div class="row">
            <div class="col-lg-6 border border-3 border-white card text-white" v-for="userPlace in userPlaces"
                :key="userPlace.id"
                :style="`background-image: url(images/${userPlace.images[0].nom}); background-position: center; background-size: cover;`">
                <div class="p-3 fs-3 placeName"> {{ userPlace.nom }} </div>
                <div v-if="userPlace.valide" class="mx-auto bg-success w-25">validé</div>
                <div v-else class="mx-auto bg-danger w-25">en attente de validation</div>
                <div class="card-body">
                    <router-link :to="`/lieu/${userPlace.id}`"><button class="btn btn-primary">Détails du lieu</button></router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>
h1 {
    color: #1C6E8C
}

i {
    color: #94D1BE
}

.placeName {
   text-shadow: 2px 2px 4px #1C6E8C;
}

.card {
    height: 35vh
}
</style>
