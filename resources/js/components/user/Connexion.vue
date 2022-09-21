<template>
    <div class="p-3">
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
</template>

<script>
import axios from 'axios'
import ValidationErrors from "../utilities/ValidationErrors.vue"
import { store } from '../../store'

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
            axios.post('/api/login', { email: this.email, password: this.password })
                .then(response => {
                    this.loginSuccess(response)
                })
                .catch(error => {
                    // on stocke les messages d'erreurs dans la variable validationErrors du composant, pour les afficher
                    this.validationErrors = error.response.data.data;
                })
        },

        loginSuccess(response) {
            console.log("loginsuccess");
            // on appelle le mutateur storeUserData pour stocker les infos utilisateur dans le store
            // ici, response.data.data est le payload transmis au store
            store.commit('storeUserData', response.data.data)
            // on appelle le mutateur storeUserLoggedIn pour mémoriser le fait que l'utilisateur soit connecté
            store.commit('storeUserLoggedIn', true)
            // on redirige vers l'accueil
            this.$router.push('/successmessage/home/' + response.data.message)
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
    background: rgba(254, 254, 254, 0.73)
}

.card-header {
    background-color: #94D1BE
}

.container-fluid {
    background-image: url(../../../../public/images/plage.jpg);
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
