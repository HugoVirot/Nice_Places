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
            avis: "",
            note: "",
            commentaire: "",
            validationErrors: ""
        }
    },

    components: { ValidationErrors },

    methods: {
        // cette fonction permet de mettre à jour les données locales du composant
        // une fois que l'appel API a récupéré l'avis
        updateLocalData(avis) {
            this.avis = avis
            this.note = avis.note
            this.commentaire = avis.commentaire
        },

        saveChanges() {

            axios.put('/api/avis/' + this.avis.id, {
                note: this.note,
                commentaire: this.commentaire,
            })
                .then((response) => {
                    // on stocke le message de succès dans le store 
                    store.commit('storeMessage', response.data.message);
                    console.log(store.state.message)

                    // on récupère la nouvelle liste des catégories 
                    axios.get('/api/avis')
                        .then(response => {
                            store.commit("storeAvis", response.data)
                            console.log("avis actualisés")
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

        axios.get("/api/avis/" + this.$route.params.id)
            .then(response => {
                this.updateLocalData(response.data)
            })
            .catch((error) => {
                console.log(error)
                this.validationErrors = error.response.data.data;
            });
    },
}
</script>

<template>

    <div class="p-3">
        <i class="fa-3x fa-solid fa-pen-to-square"></i>
        <h1 class="mt-2">Modifier avis {{ avis.id }}</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div v-if="avis !== '' && userData.role == 'admin'" class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Entrez les nouvelles informations</div>

                    <div class="card-body">

                        <form @submit.prevent="saveChanges">

                            <div class="form-group row m-2">
                                <label for="note" class="col-md-4 col-form-label text-md-right">note</label>

                                <div class="col-md-6">
                                    <input v-model="note" id="note" type="number" min="1" max="10" class="form-control"
                                        name="note" required autocomplete="note" autofocus>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="commentaire" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-md-6">
                                    <textarea v-model="commentaire" id="commentaire" class="form-control"
                                        name="commentaire" autocomplete="commentaire">
                                        commentaire (facultatif)</textarea>
                                </div>
                            </div>

                            <div class="form-group row mt-3 text-center">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit"
                                        class="greenButton btn btn-lg rounded-pill text-light btn-info">
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

.container-fluid {
    background-image: url(../../../public/images/plage.jpg);
    background-position: center;
    background-size: cover;
}

.btn {
    background-color: #94D1BE !important;
    color: white;
}
</style>