<script>
import { store } from "../store";

export default {

    computed: {
        userPlaces() {
            return store.state.userPlaces
        }
    },

    data() {
        return {
            coverPictures: []
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

        getCoverPictures() {
            this.userPlaces.forEach(place => {

                place.images.forEach(image => {

                    if (image.mise_en_avant) {
                        this.coverPictures.push(image)
                    }
                })
            })
            console.log(this.coverPictures)
        }
    },

    created() {
        // on récupère les lieux postés par l'utilisateur
        this.getLieuxPostes()

        // une fois que les lieux sont disponibles, on récupère la liste des images de couverture de ces lieux
        if (this.userPlaces) {
            this.getCoverPictures()
        }
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
            <div class="col-lg-6 border border-3 border-white card text-white" v-for="(userPlace, index) in userPlaces"
                :key="userPlace.id" :style="coverPictures[index] ? `background-image: url(images/${coverPictures[index].nom}); background-position: center; background-size: cover;` :
                    `background-image: url(images/${userPlace.images[0].nom}); background-position: center; background-size: cover;`
                ">
                <div class="p-3 fs-3 textWithShadow"> {{ userPlace.nom }} </div>
                <div v-if="userPlace.statut == 'validé'" class="mx-auto bg-success w-25">validé</div>
                <div v-else-if="userPlace.statut == 'en attente'" class="mx-auto bg-info w-25">en attente de validation
                </div>
                <div v-else-if="userPlace.statut == 'à modifier'" class="mx-auto bg-warning w-25">à modifier pour être validé
                </div>
                <div v-else class="mx-auto bg-danger w-25">refusé
                </div>
                <div class="card-body">
                    <router-link :to="`/lieu/${userPlace.id}`"><button class="btn">Détails du lieu</button>
                    </router-link>
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

.textWithShadow {
    text-shadow: 2px 2px 4px #1C6E8C;
}

.card {
    height: 35vh
}

button {
    background-color: #94DEB1;
    color: white
}

button:hover {
    background-color: #1C6E8C;
    color: white
}
</style>
