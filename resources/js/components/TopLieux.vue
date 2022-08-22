<script>
import { store } from '../store'

export default {
    // récupérer les lieux
    // computed: {
    //     topLieux() {
    //         return store.state.lieux
    //     },
    // },

    data() {
        return {
            topLieux: store.getters.getTopRatedPlaces,
            coverPictures: [],
            filtre: "departement"
        }
    },

    methods: {
        getCoverPictures() {
            this.topLieux.forEach(topLieu => {

                topLieu.images.forEach(image => {

                    if (image.mise_en_avant) {
                        this.coverPictures.push(image)
                    }
                })
            })
            console.log(this.coverPictures)
        }
    },

    created() {
        console.log(this.topLieux);

        if (this.topLieux) {
            this.getCoverPictures()
        }
    }
}
</script>

<template>
    <section id="topLieux" class="p-2">
        <div class="p-3">
            <i class="greenIcon mx-auto fa-3x fa-solid fa-message"></i>
            <h1 class="mt-2">Top des lieux</h1>
        </div>

        <h2>Afficher les lieux : </h2>

        <select required v-model="filtre" class="form-select" aria-label="filtre">
            <option value="france">de la France entière</option>
            <option value="departement">de votre département</option>
            <option value="autreDepartement">d'un autre département</option>
        </select>

        <div class="container-fluid p-3 p-lg-5">

            <div v-if="topLieux" class="row">

                <div class="col-lg-6 border border-3 border-white card text-white textWithShadow" v-for="(topLieu, index) in topLieux"
                    :key="topLieu.id" :style="coverPictures[index] ? `background-image: url(images/${coverPictures[index].nom}); background-position: center; background-size: cover;` :
                        `background-image: url(images/${topLieu.images[0].nom}); background-position: center; background-size: cover;`
                    ">
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