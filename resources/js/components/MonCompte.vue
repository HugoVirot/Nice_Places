<script>
import axios from 'axios'
import ValidationErrors from "./ValidationErrors.vue"
import { store } from '../store'
export default {

    data() {
        return {
            pseudo: store.getters.getUserData.pseudo,
            email: store.getters.getUserData.email,
            id: store.getters.getUserData.id,
            departement: store.getters.getUserData.departement,
            oldPassword: "",
            password: "",
            password_confirmation: "",
            validationErrors: ""
        }
    },

    components: { ValidationErrors },

    methods: {

        checkPassword(password) {
            console.log("lettre saisie")
        },

        sendData() {
            axios.put('/api/users/' + this.id, {
                pseudo: this.pseudo, email: this.email, departement: this.departement, oldPassword: this.oldPassword,
                password: this.password, password_confirmation: this.password_confirmation
            })
                .then((response) => {
                    this.editDataSuccess(response)
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        },

        deleteAccount() {
            axios.delete('/api/users/' + this.id)
                .then((response) => {
                    this.deleteAccountSuccess(response)
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        },

        editDataSuccess(response) {

            console.log(response)

            // on appelle le mutateur storeUserData pour stocker les infos utilisateur dans le store
            // ici, response.data.data est le payload transmis au store
            store.commit('storeUserData', response.data.data)

            // // on teste le résultat
            console.log(store.getters.getUserData)

            // //idem pour le message de succès
            store.commit('storeMessage', response.data.message)
            console.log(store.getters.getMessage)

            this.$router.push('/SuccessMessage')
        },

        deleteAccountSuccess(response) {

            store.commit('storeMessage', response.data.message)
            console.log(store.getters.getMessage)

            // la suppression fonctionne, le message de succès aussi
            //ajouter ici la déconnexion

            this.$router.push('/SuccessMessage')
        }

    },

    mounted() {
        console.log(store.getters.getUserData)
    }
}
</script>


<template>
    <div class="p-5">
        <i class="fa-solid fa-3x fa-user-check"></i>
        <h1 class="mt-2">Mon Compte</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <!-- composant affichant les erreurs de validation des formulaires -->
        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8 p-1">
                <div class="card">
                    <div class="card-header text-white mb-3">Modifier mes infos</div>

                    <form @submit.prevent="sendData">

                        <div class="card-body">

                            <div class="form-group row m-2">
                                <label for="pseudo" class="col-md-4 col-form-label text-md-right">pseudo</label>

                                <div class="col-md-6">
                                    <input v-model="pseudo" id="pseudo" type="text" class="form-control" name="pseudo"
                                        autocomplete="pseudo" autofocus>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="email" class="col-md-4 col-form-label text-md-right">e-mail</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                        autocomplete="email">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="email" class="col-md-4 col-form-label text-md-right">departement</label>

                                <div class="col-md-6">
                                    <input v-model="departement" id="departement" type="text" class="form-control"
                                        name="departement" autocomplete="departement">
                                </div>
                            </div>

                        </div>

                        <div class="card-header text-white mt-3 mb-1"> Modifier le mot de passe</div>

                        <div class="card-body">

                            <div id="infosMdp" class="form-group row">
                                <div id="passwordHelpBlock" class="mx-auto p-2 m-2 border border-info">
                                    Votre mot de passe doit comporter au moins 8 caractères. Il contenir au moins une
                                    lettre,
                                    un chiffre, une minuscule, une majuscule et un caractère spécial.
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="oldPassword" class="col-md-4 col-form-label text-md-right">mot de passe
                                    actuel</label>

                                <div class="col-md-6">
                                    <input v-model="oldPassword" id="oldPassword" type="password" class="form-control"
                                        name="oldPassword">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">nouveau mot de
                                    passe</label>

                                <div class="col-md-6">
                                    <input v-model="password" @keyup="checkPassword(password)" id="password"
                                        type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-4 offset-2 text-left">
                                        <p>minimum 8 caractères</p>
                                        <p>minimum 1 lettre</p>
                                        <p>minimum 1 chiffre</p>
                                        <p>minimum 1 majuscule et 1 minuscule</p>
                                        <p>minimum 1 caractère spécial</p>
                                    </div>
                                    <div class="col-4">
                                        <i class="fa-solid fa-xmark-large"></i><i class="p-2 fa-solid fa-check"></i>
                                        <i class="fa-solid fa-xmark-large"></i><i class="p-2 fa-solid fa-check"></i>
                                        <i class="fa-solid fa-xmark-large"></i><i class="p-2 fa-solid fa-check"></i>
                                        <i class="fa-solid fa-xmark-large"></i><i class="p-2 fa-solid fa-check"></i>
                                        <i class="fa-solid fa-xmark-large"></i><i class="p-2 fa-solid fa-check"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="password_confirmation"
                                    class="col-md-4 col-form-label text-md-right">confirmez
                                    le
                                    mot de passe</label>

                                <div class="col-md-6">
                                    <input v-model="password_confirmation" id="password_confirmation" type="password"
                                        class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row m-3 text-center">
                                <div class="col-md-6 offset-md-3">
                                    <button id="boutonValider" type="submit" class="btn btn-lg rounded-pill text-light">
                                        Valider
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="card">
                    <div class="card-header text-white mb-3">Supprimer mon compte</div>

                    <form @submit.prevent="deleteAccount">

                        <div class="card-body">

                            <i class="fa-solid fa-triangle-exclamation fa-5x text-danger mb-2"></i>

                            <p class="text-danger">Attention : cette action est irréversible.</p>
                            <p class="text-danger">En supprimant votre compte, vous perdrez tous vos favoris.</p>
                            <p>Les lieux, notes et avis que vous avez postés seront conservés (les avis seront
                                anonymisés).</p>

                            <div class="form-group row m-3 text-center">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn rounded-pill text-light btn-danger">
                                        Supprimer mon compte
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</template>


<style scoped>
.container-fluid {
    background-image: url(../../../public/images/rochers.jpg);
    background-position: center;
    background-size: cover;
}

h1 {
    color: #1C6E8C
}

i {
    color: #94D1BE
}

.card {
    color: #1C6E8C;
}

.card-header {
    background-color: #94D1BE
}

#passwordHelpBlock {
    max-width: 600px;
}

#boutonValider {
    background-color: #1C6E8C;
    color: white;
}
</style>