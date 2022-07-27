<script>
import axios from 'axios'
import ValidationErrors from "./ValidationErrors.vue"
import { store } from "../store.js";

export default {

    computed: {
        userData() {
            return store.state.userData
        }
    },

    data() {
        return {
            image: "",
            nom: "",
            mise_en_avant: "",
            validationErrors: "",
            imagesNumberForThisPlace: 0
        }
    },

    components: { ValidationErrors },

    methods: {
        // cette fonction permet de mettre à jour les données locales du composant
        // une fois que l'appel API a récupéré l'image
        updateLocalData(image) {
            this.image = image
            this.nom = image.nom
            this.mise_en_avant = image.mise_en_avant


            axios.get("/api/lieus/getimagesnumberbyplace/" + this.image.lieu_id)
                .then(response => {
                    this.imagesNumberForThisPlace = response.data
                }).catch((response) => {
                    console.log(response.error);
                })
        },

        saveChanges() {

            axios.put('/api/images/' + this.image.id, {
                nom: this.nom,
                mise_en_avant: this.mise_en_avant,
            })
                .then((response) => {
                    // on stocke le message de succès dans le store 
                    store.commit('storeMessage', response.data.message);
                    console.log(store.state.message)

                    // on récupère la nouvelle liste des catégories 
                    axios.get('/api/images')
                        .then(response => {
                            store.commit("storeImages", response.data)
                            console.log("images actualisées")
                            this.$router.push('/successmessage');
                        }).catch((response) => {
                            console.log(response.error);
                        })
                })

                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        }
    },

    created() {

        axios.get("/api/images/" + this.$route.params.id)
            .then(response => {
                this.updateLocalData(response.data)
            }).catch((response) => {
                console.log(response.error);
            })
    },
}
</script>

<template>

    <div class="p-3">
        <i class="fa-3x fa-solid fa-pen-to-square"></i>
        <h1 class="mt-2">Modifier l'image {{ image.nom }}</h1>
    </div>

    <img class="w-75" :src="`/images/${image.nom}`" :alt="`${image.nom}`">


    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div v-if="image !== '' && userData.role == 'admin'" class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Entrez les nouvelles informations</div>

                    <div class="card-body">

                        <form @submit.prevent="saveChanges">

                            <div class="form-group row m-2">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">nom</label>

                                <div class="col-md-6">
                                    <input v-model="nom" id="nom" type="text" class="form-control" name="nom" required
                                        autocomplete="nom" autofocus>
                                </div>
                            </div>

                            <div class="form-group row m-2" v-if="imagesNumberForThisPlace > 1" >
                                <label for="mise_en_avant" class="col-md-4 col-form-label text-md-right">mettre en
                                    avant</label>

                                <div class="col-md-6">
                                    <select required v-model="mise_en_avant" name="mise_en_avant" class="form-select"
                                        aria-label="mise_en_avant">
                                        <option :selected="image.mise_en_avant ? selected : ''" value="1">Oui</option>
                                        <option :selected="!image.mise_en_avant ? selected : ''" value="0">Non</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3 text-center">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-lg rounded-pill text-light btn-info">
                                        Valider
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
h1 {
    color: #1C6E8C
}

.card {
    color: #1C6E8C;
    background: rgba(254, 254, 254, 0.73)
}

.card-header {
    background-color: #94D1BE
}

.btn {
    background-color: #94D1BE !important;
    color: white;
}
</style>