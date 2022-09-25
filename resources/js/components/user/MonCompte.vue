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
                                <label for="departement" class="col-md-4 col-form-label text-md-right">département
                                    (facultatif)</label>

                                <div class="col-md-6">
                                    <select id="departement" required v-model="departement" class="form-select mx-auto"
                                        aria-label="filtre" autocomplete="departement">
                                        <option v-for="department in departements" :value="department" :selected="department.nom == departement ? 'selected' : ''">{{
                                        department.code }} - {{ department.nom }}</option>
                                    </select>
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

                            <div v-if="passwordTyped" class="container" id="dynamicPasswordCheck">

                                <div class="row">
                                    <p>minimum 8 caractères
                                        <i v-if="eightCharacters" class="p-2 fa-solid fa-check"></i>
                                        <i v-else class="fa-solid fa-xmark"></i>
                                    </p>
                                </div>

                                <div class="row">
                                    <p>minimum 1 lettre
                                        <i v-if="oneLetter" class="p-2 fa-solid fa-check"></i>
                                        <i v-else class="fa-solid fa-xmark"></i>
                                    </p>
                                </div>

                                <div class="row">
                                    <p>minimum 1 chiffre
                                        <i v-if="oneDigit" class="p-2 fa-solid fa-check"></i>
                                        <i v-else class="fa-solid fa-xmark"></i>
                                    </p>
                                </div>

                                <div class="row">
                                    <p>minimum 1 majuscule et 1 minuscule
                                        <i v-if="oneUppercaseOneLowercase" class="p-2 fa-solid fa-check"></i>
                                        <i v-else class="fa-solid fa-xmark"></i>
                                    </p>
                                </div>

                                <div class="row">
                                    <p>minimum 1 caractère spécial
                                        <i v-if="oneSpecialCharacter" class="p-2 fa-solid fa-check"></i>
                                        <i v-else class="fa-solid fa-xmark"></i>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row m-2">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">confirmez
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
                    </form>
                </div>


                <div class="card">
                    <div class="card-header text-white mb-3">Supprimer mon compte</div>

                    <form @submit.prevent="deleteAccount">

                        <div class="card-body">

                            <i class="fa-solid fa-triangle-exclamation fa-5x text-danger mb-2"></i>

                            <p class="text-danger">Attention : cette action est irréversible.</p>
                            <p class="text-danger">En supprimant votre compte, vous perdrez tous vos favoris.</p>
                            <p>Les lieux et les avis que vous avez postés seront conservés (ils seront anonymisés).</p>
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

<script>
import axios from 'axios'
import ValidationErrors from "../utilities/ValidationErrors.vue"
import { useUserStore } from '../../stores/userStore'
import { useLieuxStore } from '../../stores/lieuxStore'
import { mapWritableState } from 'pinia'
import { mapState } from 'pinia'
import { mapActions } from 'pinia'

export default {

    computed: {
        ...mapWritableState(useUserStore, [
            'pseudo',
            'email',
            'id',
            'departement'
        ]),

        ...mapState(useLieuxStore, [
            'departements'
        ]),
    },

    data() {
        return {
            passwordTyped: false,
            oldPassword: "",
            password: "",
            password_confirmation: "",
            validationErrors: "",
            eightCharacters: false,
            oneLetter: false,
            oneUppercaseOneLowercase: false,
            oneDigit: false,
            oneSpecialCharacter: false
        }
    },

    components: { ValidationErrors },

    methods: {
        ...mapActions(useUserStore, ['storeUserData', 'logOut']),

        checkPassword(password) {

            this.passwordTyped = true

            if (password.length >= 8) {
                this.eightCharacters = true
            } else {
                this.eightCharacters = false
            }

            if (password.match(/[a-z]/)) {
                this.oneLetter = true
            } else {
                this.oneLetter = false
            }

            if (password.match(/(?=.*[a-z])(?=.*[A-Z])/)) {
                this.oneUppercaseOneLowercase = true
            } else {
                this.oneUppercaseOneLowercase = false
            }

            if (password.match(/\d/)) {
                this.oneDigit = true
            } else {
                this.oneDigit = false;
            }

            if (password.match(/[!@#$%^&*?]/)) {
                this.oneSpecialCharacter = true
            } else {
                this.oneSpecialCharacter = false;
            }
        },

        sendData() {
            console.log('senddata'); // ok on passe ici
            axios.put('/api/users/' + this.id, { // requête marche car modif ok en bdd
                pseudo: this.pseudo, email: this.email, departement_id: this.departement.id, oldPassword: this.oldPassword,
                password: this.password, password_confirmation: this.password_confirmation
            }).then(response => { // on devrait passer ici...
                this.storeUserData(response.data.data)
                this.$router.push('/successmessage/lastpage/' + response.data.message)
            }).catch((error) => {
                this.validationErrors = error.response.data.data; // on passe ici de façon incompréhensible (modif marche)
            })
        },

        deleteAccount() {
            axios.delete('/api/users/' + this.id)
                .then((response) => {
                    // suppression compte réussie => déconnexion + retour accueil
                    this.logOut()
                    this.$router.push('/SuccessMessage/home/' + response.data.message)
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        },
    }
}
</script>

<style scoped>
.container-fluid {
    background-image: url(../../../../public/images/rochers.jpg);
    background-position: center;
    background-size: cover;
}

h1 {
    color: #1C6E8C
}

i {
    color: #94D1BE
}

.fa-xmark {
    color: red
}

.card {
    color: #1C6E8C;
    background: rgba(254, 254, 254, 0.73)
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