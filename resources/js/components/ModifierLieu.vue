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
            lieuId: this.$route.params.id,
            lieu: "",
            nom: "",
            description: "",
            latitude: "",
            longitude: "",
            categorie: "",
            categories: store.state.categories,
            note: "",
            temps: "",
            difficulte: "",
            kilometres: "",
            adresse: "",
            code_postal: "",
            ville: "",
            valide: "",
            validationErrors: ""
        }
    },

    components: { ValidationErrors },

    methods: {
        // cette fonction permet de mettre à jour les données locales du composant
        // une fois que l'appel API a récupéré le lieu
        updateLocalData(lieu) {
            console.log(lieu)
            this.lieu = lieu
            this.nom = lieu.nom
            this.description = lieu.description
            this.latitude = lieu.latitude
            this.longitude = lieu.longitude
            this.note = lieu.note
            this.categorie = lieu.categorie
            this.temps = lieu.temps
            this.difficulte = lieu.difficulte
            this.kilometres = lieu.kilometres
            this.adresse = lieu.adresse
            this.code_postal = lieu.code_postal
            this.ville = lieu.ville
            this.valide = lieu.valide
        },

        saveChanges() {

            axios.put('/api/lieus/' + this.lieu.id, {
                nom: this.nom,
                description: this.description,
                latitude: this.latitude,
                longitude: this.longitude,
                categorie_id: this.categorie,
                note: this.note,
                temps: this.temps,
                difficulte: this.difficulte,
                kilometres: this.kilometres,
                adresse: this.adresse,
                code_postal: this.code_postal,
                ville: this.ville,
                valide: this.valide
            })
                .then(response => {
                    // on stocke le message de succès dans le store 
                    store.commit('storeMessage', response.data.message);
                    console.log(store.state.message)

                    axios.get('/api/lieus')
                        .then(response => {
                            store.commit("storeLieux", response.data)
                            console.log("lieux actualisés")
                            this.$router.push('/successmessage');
                        }).catch((response) => {
                            console.log(response.error);
                        })
                })

                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })


            // on appelle le mutateur storeUserData pour stocker les infos utilisateur dans le store
            // ici, response.data.data est le payload transmis au store
            store.commit('storeUserData', response.data.data)

            // // on teste le résultat
            console.log(store.state.userData)

            // //idem pour le message de succès
            store.commit('storeMessage', response.data.message)
            console.log(store.state.message)

            // on redirige vers l'accueil
            this.$router.push('/SuccessMessage')
        }
    },

    created() {

        axios.get("/api/lieus/" + this.lieuId)
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
        <h1 class="mt-2">Modifier {{ lieu.nom }}</h1>
    </div>

    <div v-if="lieu.valide" class="text-white mx-auto bg-success w-25 mb-3">validé</div>
    <div v-else class="text-white mx-auto bg-danger w-25 mb-3">en attente de validation</div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div v-if="lieu !== ''" class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Entrez les nouvelles informations</div>

                    <div class="card-body">

                        <form @submit.prevent="saveChanges">

                            <div v-if="userData.role == 'admin'" class="form-group row m-2">
                                <label for="valide" class="col-md-4 col-form-label text-md-right">valider le
                                    lieu</label>

                                <div class="col-md-6">
                                    <select required v-model="valide" class="form-select" aria-label="valide">
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                            </div>

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
                            <div class="form-text mb-2">entre -180 et 180. Partie décimale : maximum 7 chiffres.</div>

                            <p>Catégorie actuelle : {{ categorie.nom }}</p>
                            
                            <div class="form-group row m-2">
                                <label for="categorie" class="col-md-4 col-form-label text-md-right">catégorie</label>

                                <div class="col-md-6">
                                    <select v-model="categorie" class="form-select" aria-label="categorie">
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
                                        class="form-control" name="kilometres" autocomplete="kilometres">
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
    background-image: url(../../../public/images/plage.jpg);
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