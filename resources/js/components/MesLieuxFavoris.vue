<script>
import { store } from "../store"

export default {
    computed: {
        favoris() {
            return store.state.favoris
        }
    },

    data() {
        return {
            coverPictures: []
        }
    },

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

        getCoverPictures() {
            this.favoris.forEach(place => {

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
        this.getFavoris()

        // une fois que les lieux sont disponibles, on récupère la liste des images de couverture de ces lieux
        if (this.favoris) {
            this.getCoverPictures()
        }
    }
}
</script>

<template>

    <div class="p-3">
        <i class="greenIcon mx-auto fa-2x fa-solid fa-user"></i>
        <h1 class="mt-2">Mes lieux favoris</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <div v-if="favoris.length > 0" class="row">
            <div class="col-lg-6 border border-3 border-white card text-white" v-for="(favori, index) in favoris"
                :key="favori.id" :style="coverPictures[index] ? `background-image: url(images/${coverPictures[index].nom}); background-position: center; background-size: cover;` :
                    `background-image: url(images/${favori.images[0].nom}); background-position: center; background-size: cover;`
                ">
                <div class="p-3 fs-3 placeName"> {{ favori.nom }} </div>
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

.placeName {
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