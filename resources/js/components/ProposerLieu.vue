<script>
import axios from "axios";
import { store } from "../store";
import ValidationErrors from "./ValidationErrors.vue"

// const dropzone = new Dropzone("div#uploadImages", { url: "/api/images"})

export default {
    computed: {
        categories() {
            return store.state.categories
        }
    },

    data() {
        return {
            nom: "",
            description: "",
            images: [],
            latitude: "",
            longitude: "",
            categorie: "",
            note: "",
            temps: "",
            difficulte: "",
            kilometres: "",
            adresse: "",
            code_postal: "",
            ville: "",
            validationErrors: "",
            formData: new FormData()
        }
    },

    components: { ValidationErrors },

    methods: {
        onChange(e) {

            let imagesChoisies = e.target.files;

            console.log(imagesChoisies)  // OK

            for (let i = 0; i < imagesChoisies.length; i++) {
                this.formData.append('images[' + i + ']', imagesChoisies[i]);
            }

            console.log(this.formData)

        },
        // poste le nouveau lieu pour le sauvegarder en base de données

        sendData() {

            this.formData.append("nom", this.nom); // this should be your image
            this.formData.append("description", this.description); // this should be your image
            this.formData.append("latitude", this.latitude); // this should be your image
            this.formData.append("longitude", this.longitude); // this should be your image
            this.formData.append("categorie", this.categorie); // this should be your image
            this.formData.append("note", this.note); // this should be your image
            this.formData.append("temps", this.temps); // this should be your image
            this.formData.append("difficulte", this.difficulte); // this should be your image
            this.formData.append("kilometres", this.kilometres); // this should be your image
            this.formData.append("adresse", this.adresse); // this should be your image
            this.formData.append("code_postal", this.code_postal); // this should be your image
            this.formData.append("ville", this.ville); // this should be your image
            this.formData.append("user_id", store.state.userData.id); // this should be your image

            axios.post('/api/lieus', this.formData, { 'content-type': 'multipart/form-data' })
                .then((response) => {

                    // on stocke le message de succès dans le store ("création de lieu réussie")
                    store.commit('storeMessage', response.data.message);

                    // on récupère la nouvelle liste des lieux (avec le nouveau lieu en +)
                    axios.get('/api/lieus').then(response => {

                        // on la stocke dans le store
                        store.commit('storeLieux', response.data)
                        console.log(store.state.lieux)

                        // on redirige vers l'accueil
                        this.$router.push('/SuccessMessage')

                    }).catch(response => console.log(response.error))

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
        <i class="mx-auto fa-3x fa-solid fa-paper-plane"></i>
        <h1 class="mt-2">Proposer un lieu</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Partagez vos coups de coeur avec nous !</div>

                    <div class="card-body">

                        <form @submit.prevent="sendData" enctype="multipart/form-data">

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

                            <div class="form-group row mx-2 mt-3">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">photos</label>
                                <input multiple type="file" class="form-control-file col-md-8" v-on:change="onChange">
                            </div>

                            <div class="form-group row mx-2 mt-3">
                                <div class="form-text mb-3 col-md-8 offset-md-4">
                                    <ul class="text-start ms-5 ms-md-0">
                                        <li>
                                            Maximum 5 photos et 2 Mo par photo.
                                        </li>
                                        <li>
                                            Uniquement en format paysage svp.
                                        </li>
                                        <li>
                                            La première choisie sera la photo de couverture. </li>
                                        <li>
                                            Sur PC, maintenez la touche CTRL pour sélectionner plusieurs photos.
                                        </li>
                                        <li>
                                            Sur mobile, explication à venir. </li>
                                    </ul>
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
                                        <option v-for="categorie in categories" :key="categorie.id"
                                            :value="categorie.id">{{ categorie.nom }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="note" class="col-md-4 col-form-label text-md-right">votre note sur
                                    10</label>

                                <div class="col-md-6">
                                    <input v-model="note" id="note" min="0" max="10" type="number" class="form-control"
                                        name="note" required autocomplete="note">
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
                                <label for="temps" class="col-md-4 col-form-label text-md-right">distance moyenne en
                                    km (facultatif)</label>

                                <div class="col-md-6">
                                    <input min="1" max="150" v-model="kilometres" id="kilometres" type="number"
                                        class="form-control" name="kilometres" required autocomplete="kilometres">
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

i {
    color: #94D1BE
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