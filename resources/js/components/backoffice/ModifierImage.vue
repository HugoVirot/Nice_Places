<template>
    <div class="p-3">
        <i class="fa-3x fa-solid fa-pen-to-square"></i>
        <h1 class="mt-2">Modifier l'image {{ image.nom }}</h1>
    </div>

    <p>postée par {{ pseudo }}</p>

    <img class="w-75" :src="`/images/${image.nom}`" :alt="`${image.nom}`">


    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div v-if="image !== '' && role == 'admin'" class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Entrez les nouvelles informations</div>

                    <div class="card-body">

                        <form @submit.prevent="saveChanges">

                            <div class="form-group row m-2" v-if="imagesNumberForThisPlace > 1">
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

<script>
import axios from 'axios'
import ValidationErrors from "../utilities/ValidationErrors.vue"
import { useUserStore } from "../../stores/userStore.js";
import { useLieuxStore } from '../../stores/lieuxStore';
import { mapState } from 'pinia';
import { mapActions } from 'pinia';

export default {

    computed: {
        ...mapState(useUserStore, ['pseudo', 'role'])
    },

    data() {
        return {
            image: "",
            nom: "",
            mise_en_avant: "",
            validationErrors: "",
            imagesNumberForThisPlace: 1
        }
    },

    components: { ValidationErrors },

    methods: {
        ...mapActions(useLieuxStore, ['storeImages']),

        // cette fonction permet de mettre à jour les données locales du composant
        // une fois que l'appel API a récupéré l'image
        updateLocalData(image) {
            this.image = image
            this.nom = image.nom
            this.mise_en_avant = image.mise_en_avant

            if (this.image.lieu_id){
            axios.get("/api/lieus/getimagesnumberbyplace/" + this.image.lieu_id)
                .then(response => {
                    this.imagesNumberForThisPlace = response.data
                }).catch((response) => {
                    console.log(response.error);
                })
            }
        },

        saveChanges() {

            axios.put('/api/images/' + this.image.id, {
                mise_en_avant: this.mise_en_avant,
            })
                .then((response) => {

                    let message = response.data.message
                    // on récupère la nouvelle liste des catégories 
                    axios.get('/api/images')

                        .then(response => {
                            this.storeImages(response.data)
                            this.$router.push('/SuccessMessage/backoffice/' + message)

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