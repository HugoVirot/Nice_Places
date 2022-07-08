<script>
import { store } from "../store";
import ValidationErrors from "./ValidationErrors.vue"

export default {
    data() {
        return {
            nom: "",
            description: "",
            latitude: "",
            longitude: "",
            categorie: "",
            note: "",
            temps: "",
            difficulte: "",
            adresse: "",
            code_postal: "",
            ville: "",
            validationErrors: "",
            categories: store.getters.getCategories
        }
    },
    components: { ValidationErrors },

    methods: {
        sendData() {
            axios.post('/api/lieus', {
                nom: this.nom,
                description: this.description,
                latitude: this.latitude,
                longitude: this.longitude,
                categorie: this.categorie,
                note: this.note,
                temps: this.temps,
                difficulte: this.difficulte,
                adresse: this.adresse,
                code_postal: this.code_postal,
                ville: this.ville,
                user_id: store.getters.getUserData.id
            })
                .then((response) => {
                    // on stocke le message de succès dans le store ("création de lieu réussie")
                    store.commit('storeMessage', response.data.message);
                    console.log(store.getters.getMessage)
                    this.$router.push('/successmessage');
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        },
    }
}
</script>

<template>

    <div class="p-5">
        <i class="mx-auto fa-solid fa-droplet"></i>
        <h1 class="mt-2">Proposer un lieu</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Faites-nous partager votre coup de coeur !</div>

                    <div class="card-body">

                        <form @submit.prevent="sendData">

                            <div class="form-group row m-2">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">nom</label>

                                <div class="col-md-6">
                                    <input v-model="nom" id="nom" type="text" class="form-control" name="nom" required
                                        autocomplete="nom" autofocus>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-right">description</label>

                                <div class="col-md-6">
                                    <textarea v-model="description" id="description" class="form-control"
                                        name="description" required autocomplete="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="latitude" class="col-md-4 col-form-label text-md-right">latitude</label>

                                <div class="col-md-6">
                                    <input v-model="latitude" id="latitude" type="text" class="form-control"
                                        name="latitude" required autocomplete="latitude">
                                </div>
                            </div>
                            <div class="form-text">entre -90 et 90. Partie décimale : maximum 7 chiffres.</div>

                            <div class="form-group row m-2">
                                <label for="longitude" class="col-md-4 col-form-label text-md-right">longitude</label>

                                <div class="col-md-6">
                                    <input v-model="longitude" id="longitude" type="text" class="form-control"
                                        name="longitude" required autocomplete="longitude">
                                </div>
                            </div>
                            <div class="form-text">entre -180 et 180. Partie décimale : maximum 7 chiffres.</div>

                            <div class="form-group row m-2">
                                <label for="categorie" class="col-md-4 col-form-label text-md-right">catégorie</label>

                                <div class="col-md-6">
                                    <select required v-model="categorie" class="form-select" aria-label="categorie">
                                        <option v-for="categorie in categories" :key="categorie.id" :value="categorie.id">{{categorie.nom}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="note" class="col-md-4 col-form-label text-md-right">note sur 10</label>

                                <div class="col-md-6">
                                    <input v-model="note" id="note" type="number" class="form-control" name="note"
                                        required autocomplete="note">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="temps" class="col-md-4 col-form-label text-md-right">temps moyen en
                                    heures</label>

                                <div class="col-md-6">
                                    <input min="1" max="24" v-model="temps" id="temps" type="number"
                                        class="form-control" name="temps" required autocomplete="temps">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="temps" class="col-md-4 col-form-label text-md-right">niveau de
                                    difficulté</label>

                                <div class="col-md-6">
                                    <select required v-model="difficulte" class="form-select" aria-label="difficulte">
                                        <option selected value="famille">famille</option>
                                        <option value="amateur">amateur</option>
                                        <option value="sportif">sportif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="adresse" class="col-md-4 col-form-label text-md-right">adresse</label>

                                <div class="col-md-6">
                                    <input v-model="adresse" id="adresse" type="text" class="form-control"
                                        name="adresse" required autocomplete="adresse">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="code_postal" class="col-md-4 col-form-label text-md-right">code
                                    postal</label>

                                <div class="col-md-6">
                                    <input v-model="code_postal" id="code_postal" type="text" class="form-control"
                                        name="code_postal" required autocomplete="code_postal">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="ville" class="col-md-4 col-form-label text-md-right">ville</label>

                                <div class="col-md-6">
                                    <input v-model="ville" id="ville" type="text" class="form-control" name="ville"
                                        required autocomplete="ville">
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

    <div class="modal bg-success" id="successModal" ref="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Félicitations !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Inscription réussie ! </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>
h1 {
    color: #1C6E8C
}

img {
    width: 6vw
}

.card {
    color: #1C6E8C;
    background: rgba(254, 254, 254, 0.73)
}

.card-header {
    background-color: #94D1BE
}

.container-fluid {
    background-image: url(../../../public/images/riviere.jpg);
    background-position: center;
    background-size: cover;
}

.btn {
    background-color: #94D1BE !important;
    color: white;
}

@media screen and (max-width: 768px) {
    img {
        width: 10vw
    }
}
</style>