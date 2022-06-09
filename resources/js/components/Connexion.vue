<script>
import axios from 'axios'
import ValidationErrors from "./ValidationErrors.vue"
import { store } from "../store.js";

export default {

    data() {
        return {
            email: "",
            password: "",
            validationErrors: ""
        }
    },
    components: { ValidationErrors },
    methods: {
        logIn() {  
            // console.log(store.getters.getUserData) // MARCHE (on peut accéder à userData)
            // store.commit('storeUserData', { pseudo: "test2", email:" test2@test", token: "aajreg645r4f5erf"})
            // console.log(store.getters.getUserData) // MARCHE (on peut accéder à userData)

            axios.post('/api/login', { email: this.email, password: this.password })

                .then(response => {
                    this.loginSuccess(response)
                })

                .catch(error => {
                    console.log(error.response)
                    // on stocke les messages d'erreurs dans la variable validationErrors du composant
                    this.validationErrors = error.response.data.data;
                })
        },
        loginSuccess(response) {
            
            console.log(response)

            // on appelle le mutateur storeUserData pour stocker les infos utilisateur dans le store
            // ici, response.data.data est le payload transmis au store
            store.commit('storeUserData', response.data.data)

            // // on teste le résultat
            console.log(store.getters.getUserData)

            // //idem pour le message de succès
            store.commit('storeMessage', response.data.message)
            console.log(store.getters.getMessage)

            // on redirige vers l'accueil
            this.$router.push('/SuccessMessage')
        }
    }
}
</script>

<style scoped>
h1 {
    color: #1C6E8C
}

img {
    width: 6vw
}

.card {
    color: #1C6E8C;
}

.card-header {
    background-color: #94D1BE
}

.container-fluid {
    background-image: url(../../../public/images/plage.jpg);
    background-position: center;
    background-size: cover;
}


@media screen and (max-width: 768px) {
    img {
        width: 10vw
    }
}
</style>

<template>

    <div class="p-5">
        <img class="mx-auto" src="images/icons/user.png" alt="user">
        <h1 class="mt-2">Connexion</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Entrez ici vos informations</div>

                    <div class="card-body">

                        <form @submit.prevent="logIn">

                            <div class="form-group row m-2">
                                <label for="email" class="col-md-4 col-form-label text-md-right">e-mail</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                        required autocomplete="email">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">mot de passe</label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control"
                                        name="password" required autocomplete="new-password">
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
<!-- 
    <div v-if="loginSuccess" class="modal bg-success" id="successModal" ref="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Félicitations !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Vous êtes connecté(e) ! </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->
</template>