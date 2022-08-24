<script>
import { store } from "../store"
import Filtres from "./Filtres.vue"
import Tris from "./Tris.vue"

export default {
    // computed: {
    //     favoris() {
    //         return store.state.favoris
    //     }
    // },

    data() {
        return {
            favoris: store.state.favoris,
            favorisNonFiltres: ''
        }
    },

    components: { Filtres, Tris },

    methods: {

        getFavoris() {
            axios.get('/api/favoris/' + store.state.userData.id)
                .then(response => {
                    store.commit('storeFavoris', response.data);
                    console.log(store.state.favoris)
                }).catch((response) => {
                    console.log(response.error);
                })
        },

        updateLieux(lieuxTries) {  // déclenchée si filtre appliqué via composant enfant Filtres
            this.favoris = lieuxTries // on remplace les lieux de la catégorie par les lieux filtrés 
        }

    },
    created() {
        // on récupère les lieux postés par l'utilisateur
        this.getFavoris()

        this.favorisNonFiltres = this.favoris
    }
}
</script>

<template>

    <div class="p-3">
        <i class="greenIcon mx-auto fa-2x fa-solid fa-user"></i>
        <h1 class="mt-2">Mes lieux favoris</h1>
    </div>

    <Filtres :lieux="favoris" :lieuxNonFiltres="favorisNonFiltres" @filtre_applique="updateLieux" />

    <Tris :lieux="favoris" @lieux_tries="updateLieux" />

    <div class="container-fluid p-3 p-lg-5">

        <div v-if="favoris.length > 0" class="row">
            <div class="col-lg-6 border border-3 border-white card text-white" v-for="(favori, index) in favoris"
                :key="favori.id"
                :style="`background-image: url(images/${favori.image_mise_en_avant.nom}); background-position: center; background-size: cover;`">
                <div class="p-3 fs-3 textWithShadow"> {{ favori.nom }} </div>
                <div class="card-body">
                    <router-link :to="`/lieu/${favori.id}`"><button class="btn greenButton">Détails du lieu</button>
                    </router-link>
                </div>
            </div>
        </div>

        <div v-else>
            <p>Vous n'avez aucun lieu dans vos favoris.</p>
        </div>

    </div>

</template>

<style scoped>
.greenIcon {
    color: #94DEB1
}

h1 {
    color: #1C6E8C
}

p {
    color: grey
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