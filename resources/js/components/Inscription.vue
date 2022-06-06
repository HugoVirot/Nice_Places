<script>
import axios from 'axios'
import ValidationErrors from "./ValidationErrors.vue"

export default {

    data() {
        return {
            pseudo: "",
            email: "",
            password: "",
            password_confirmation: "",
            validationErrors: ""
        }
    },
    components: { ValidationErrors },
    methods: {
        sendData() {
            axios.post('/api/register', { pseudo: this.pseudo, email: this.email, password: this.password, password_confirmation: this.password_confirmation })
                .then(() => {
                    //document.getElementById('#successModal').modal('show')
                    this.$refs['successModal'].modal('show')
                    //router.push('/connexion')
                     this.$router.push('/connexion')
                })
                .catch((error) => {
                    // problème : inscription réussie = passage dans le .catch
                    // => error undefined (logique)
                    let errormessages = error.response.data.data
                    // fonctionne (testé en console)
                    console.log(error.response)
                    for (let errormessage in errormessages) {
                        this.validationErrors = error.response.data.data;
                        alert(errormessages[errormessage])
                    }
                })
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
                                    <input v-model="password" id="password" type="password" class="form-control"
                                        name="password" required autocomplete="new-password">
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