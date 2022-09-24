<template>

    <div class="p-3">
        <i class="greenIcon mx-auto fa-2x fa-solid fa-user"></i>
        <h1 class="mt-2">Mes lieux favoris</h1>
    </div>

    <Filtres :lieux="favoris" :lieuxNonFiltres="favorisNonFiltres" @filtre_applique="updateLieux" />

    <Tris :lieux="favoris" @lieux_tries="updateLieux" />

    <div class="container-fluid p-3 p-lg-5">

        <div v-if="favoris.length > 0" class="row">
            <div class="col-lg-6 border border-3 border-white card text-white" v-for="favori in favoris"
                :key="favori.id"
                :style="`background-image: url(images/${favori.image_mise_en_avant[0].nom}); background-position: center; background-size: cover;`">
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

<script>
import { useUserStore } from "../../stores/userStore"
import { mapState } from "pinia"
import Filtres from "../utilities/Filtres.vue"
import Tris from "../utilities/Tris.vue"

export default {
    data() {
        return {
            favorisNonFiltres: ''
        }
    },

    computed: {
        ...mapState(useUserStore, ['id', 'favoris'])
    },

    components: { Filtres, Tris },

    methods: {

        // récupérer les favoris de l'utilisateur
        getFavoris() {
            axios.get('/api/favoris/' + this.id)
                .then(response => {
                    this.storeFavoris(response.data);
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

        // on stocke les favoris dans une variable pour conserver la liste de base en cas de tri
        this.favorisNonFiltres = this.favoris
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