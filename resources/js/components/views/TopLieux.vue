<script>
import { mapWritableState } from 'pinia'
import Filtres from "../utilities/Filtres.vue"
import { useLieuxStore } from '../../stores/lieuxStore'

export default {

    computed: {
        ...mapWritableState(useLieuxStore, ['getTopRatedPlaces']),
    },

    data() {
        return {
            topLieux: '',
            topLieuxNonFiltres: ''
        }
    },

    components: { Filtres },

    methods: {
        updateLieux(lieuxTries) {  // déclenchée si filtre appliqué via composant enfant Filtres
            this.topLieux = lieuxTries // on remplace le classement affiché par les lieux filtrés 
        }
    },

    created() {
        // on appelle le getter getTopRatedPlaces pour récupérer les 100 lieux les mieux notés
        // on les stocke dans la variable toplieux des datas
        this.topLieux = this.getTopRatedPlaces
        // on garde une copie de cette liste des 100 lieux les mieux notés en cas de retour
        // à l'affichage normal après avoir effectué un ou plusieurs tris
        this.topLieuxNonFiltres = this.topLieux
    }
}
</script>

<template>
    <section id="topLieux" class="p-2 text-secondary">
        <div class="p-3">
            <i class="greenIcon mx-auto fa-3x fa-solid fa-message"></i>
            <h1 class="mt-2">Top 100 des lieux</h1>
        </div>

        <Filtres :lieux="topLieux" :lieuxNonFiltres="topLieuxNonFiltres" @filtre_applique="updateLieux" />

        <div class="container-fluid p-3 p-lg-5">

            <div v-if="topLieux" class="row">

                <div v-if="topLieux.length > 0"
                    class="col-lg-6 border border-3 border-white card text-white textWithShadow"
                    v-for="(topLieu, index) in topLieux" :key="topLieu.id"
                    :style="`background-image: url(images/${topLieu.image_mise_en_avant[0].nom}); background-position: center; background-size: cover;`">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <span class="ranking">#{{ index + 1 }}</span>
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <p><i class="yellowStar fa-2x fa-solid fa-star ms-2 me-1"></i>
                                <span class="fs-2">{{ topLieu.note }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="p-3 fs-3"> {{ topLieu.nom }} </div>
                    <div class="card-body">
                        <router-link :to="`/lieu/${topLieu.id}`"><button class="btn greenButton">Détails du
                                lieu</button>
                        </router-link>
                    </div>
                </div>

                <div v-else>
                    <p>Aucun lieu de ce département dans le top 100.</p>
                </div>

            </div>

            <div v-else>
                <p>chargement en cours...</p>
            </div>

        </div>
    </section>
</template>

<style scoped>
.textWithShadow {
    text-shadow: 2px 2px 4px #1C6E8C;
}

.greenIcon {
    color: #94DEB1
}

.greenBackground {
    background-color: #94DEB1;
}

.ranking {
    font-size: 4em;
}

h1 {
    color: #1C6E8C
}

.yellowStar {
    color: yellow
}

.textWithShadow {
    text-shadow: 2px 2px 4px #1C6E8C;
}

.greenButton {
    color: white;
    background-color: #94D1BE;
}
</style>