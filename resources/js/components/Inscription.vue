<script>
import axios from 'axios'
import ValidationErrors from "./ValidationErrors.vue"
import { store } from "../store.js";

export default {

    data() {
        return {
            pseudo: "",
            email: "",
            password: "",
            password_confirmation: "",
            validationErrors: "",
            passwordTyped: false,
            eightCharacters: false,
            oneLetter: false,
            oneUppercaseOneLowercase: false,
            oneDigit: false,
            oneSpecialCharacter: false
        }
    },
    components: { ValidationErrors },

    methods: {
        sendData() {
            axios.post('/api/register', { pseudo: this.pseudo, email: this.email, password: this.password, password_confirmation: this.password_confirmation })
                .then((response) => {
                    // on stocke le message de succès dans le store ("inscription réussie")
                    store.commit('storeMessage', response.data.message);
                    console.log(store.getters.getMessage)
                    this.$router.push('/successmessage');
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        },

        checkPassword(password) {

            this.passwordTyped = true

            let correctCriterias = 0;

            if (password.length >= 8) {
                this.eightCharacters = true
                correctCriterias++
            } else {
                this.eightCharacters = false
            }

            if (password.match(/[a-z]/)) {
                this.oneLetter = true
                correctCriterias++
            } else {
                this.oneLetter = false
            }

            if (password.match(/(?=.*[a-z])(?=.*[A-Z])/)) {
                this.oneUppercaseOneLowercase = true
                correctCriterias++
            } else {
                this.oneUppercaseOneLowercase = false
            }

            if (password.match(/\d/)) {
                this.oneDigit = true
                correctCriterias++
            } else {
                this.oneDigit = false;
            }

            if (password.match(/[!@#$%^&*?]/)) {
                this.oneSpecialCharacter = true
                correctCriterias++
            } else {
                this.oneSpecialCharacter = false;
            }

            if (correctCriterias == 7) {
                this.passwordTyped = false
            }
        }
    }
}
</script>

<style scoped>
/*#94D1BE*/

img {
    width: 6vw
}

.container-fluid {
    background-image: linear-gradient(rgba(132, 247, 192, 0.4),
            rgba(7, 117, 230, 0.3)), url(../../../public/images/foret.jpg);
    background-position: center;
    background-size: cover;
}

h1 {
    color: #1C6E8C
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

i {
    color: #94D1BE
}

.fa-xmark {
    color: red
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
        <h1 class="mt-2">Inscription</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />
        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Quelques secondes suffisent !</div>

                    <div class="card-body">

                        <form @submit.prevent="sendData">

                            <div class="form-group row m-2">
                                <label for="pseudo" class="col-md-4 col-form-label text-md-right">pseudo</label>

                                <div class="col-md-6">
                                    <input v-model="pseudo" id="pseudo" type="text" class="form-control" name="pseudo"
                                        required autocomplete="pseudo" autofocus>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="email" class="col-md-4 col-form-label text-md-right">e-mail</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                        required autocomplete="email">
                                </div>
                            </div>

                            <div id="infosMdp" class="form-group row my-2">
                                <div id="passwordHelpBlock" class="mx-auto p-2 m-2 border border-info">
                                    Votre mot de passe doit comporter au moins 8 caractères. Il contenir au moins une
                                    lettre,
                                    un chiffre, une minuscule, une majuscule et un caractère spécial.
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">mot de passe</label>

                                <div class="col-md-6">
                                    <input v-model="password" @keyup="checkPassword(password)" id="password"
                                        type="password" class="form-control" name="password" required
                                        autocomplete="new-password">
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

                            <div class="form-group row m-2">
                                <label for="password_confirmation"
                                    class="col-md-4 col-form-label text-md-right">confirmez le
                                    mot de passe</label>

                                <div class="col-md-6">
                                    <input v-model="password_confirmation" id="password_confirmation" type="password"
                                        class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
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