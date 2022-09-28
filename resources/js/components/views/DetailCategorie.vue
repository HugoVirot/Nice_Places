<template>

    <div v-if="categorie" class="container-fluid p-5"
        :style="`background-image: url(/images/categorie${categorie.id}.jpg); background-position: center; background-size: cover;`">

        <div class="m-auto">
            <span class="fa-5x iconWithShadow" v-html="categorie.icone" :style="{color: categorie.couleur}"></span>
            <h1 class="textWithShadow bigFontSize text-white">{{ categorie.nom }}</h1>
        </div>

    </div>

    <Tris :lieux="categorie.lieux" @lieux_tries="updateLieux" />

    <Filtres :lieux="categorie.lieux" :lieuxNonFiltres="lieuxNonFiltres" @filtre_applique="updateLieux" />

    <div class="container-fluid p-3 p-lg-5 mt-3">

        <div v-if="!this.loading">
            <p v-if="categorie.lieux.length > 0" class="pb-2 fs-3">{{ categorie.lieux.length }} lieu(x) trouvé(s)</p>
            <p v-else class="pb-2 fs-3">aucun lieu trouvé</p>
        </div>

        <div class="row">
            <!-- composant qui affiche les lieux (le créer et lui passer les lieux en props)-->
            <div class="col-lg-6 border border-3 border-white card text-white" v-for="(lieu, index) in categorie.lieux"
                :key="lieu.id"
                :style="`background-image: url(/images/${lieu.image_mise_en_avant[0].nom}); background-position: center; background-size: cover;`">
                <span class="m-auto">
                    <div class="p-2 textWithShadow">
                        <p class="fs-1 text-white">{{ lieu.nom }}</p>
                        <p class="text-white fs-4">
                            <i class="yellowStar fa-solid fa-star ms-2 me-1"></i>{{ lieu.note }}
                            <i class="greenIcon fa-solid fa-hourglass-half ms-2 me-1"></i>
                            {{ lieu.temps }} heure(s)
                            <i class="greenIcon fa-solid fa-gauge-simple-high ms-2 me-1"></i>
                            {{ lieu.difficulte }}
                        </p>
                    </div>
                    <router-link :to="`/lieu/${lieu.id}`"><button class="btn btn-lg">Détails du lieu</button>
                    </router-link>
                </span>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import Filtres from "../utilities/Filtres.vue"
import Tris from "../utilities/Tris.vue"

export default {
    data() {
        return {
            categorie: '',
            loading: true,
            lieuxNonFiltres: ''
        }
    },

    components: { Filtres, Tris },

    methods: {
        updateLieux(lieuxTriesOuFiltres) {  // déclenchée si tri ou filtre appliqué via composant enfant Tris ou  Filtres
            this.categorie.lieux = lieuxTriesOuFiltres // on remplace les lieux de la catégorie par les lieux triés ou filtrés 
        },

        // filtre les lieux en ne gardant que ceux validés
        getValidatedPlaces() {
            this.categorie.lieux = this.categorie.lieux.filter(lieu => lieu.statut == "validé")
        }
    },

    // on récupère la catégorie en fonction de l'id passé en paramètre de la route
    created() {
        axios.get("/api/categories/" + this.$route.params.id)
            .then(response => {
                this.categorie = response.data
                this.getValidatedPlaces()
                this.loading = false
                this.lieuxNonFiltres = this.categorie.lieux
            }).catch(() => { // message d'erreur pour l'utilisateur en cas d'échec de l'appel API
                alert("Une erreur s'est produite. Certains éléments peuvent ne pas être affichés. Vous pouvez essayer de recharger la page pour corriger le problème.")
            })
    }
}
</script>

<style scoped>
.greenIcon {
    color: #94D1BE
}

h1,
h2 {
    color: #1C6E8C
}

.yellowStar {
    color: yellow
}

p {
    color: grey
}

.bigFontSize {
    margin-top: -4vh;
    font-size: 4em;
}

.iconWithShadow {
    text-shadow: 2px 2px 4px #fff;
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

@media screen and (max-width: 568px) {
    .bigFontSize {
        margin-top: -3vh;
        font-size: 3em;
    }
}
</style>