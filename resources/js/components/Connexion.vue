<script>
import axios from 'axios'
import ValidationErrors from "./ValidationErrors.vue"

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
                .then((response) => {
                    console.log(response)
                    //document.getElementById('#successModal').modal('show')
                    this.$refs['successModal'].modal('show')
                    router.push('/')
                    this.$router.push('/')
                })
                .catch((error) => {
                  // problème : inscription réussie (réponse = code 200) = passage dans le .catch
                    // => error undefined (logique)
                    // même pb que pour l'inscription
                    let errormessages = error.response.data.data
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

<template>

    <div class="p-5">
        <!-- <img class="mx-auto" src="images/icons/user.png" alt="user"> -->
        <h1 class="mt-2">Connexion</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Lorem ipsum</div>

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

    <div class="modal bg-success" id="successModal" ref="successModal" tabindex="-1">
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
    </div>
</template>