<template>
    <div class="container-fluid p-3 p-lg-4">

        <div class="m-3">
            <i class="mx-auto fa-solid fa-pen fa-3x"></i>
            <h2 class="mt-2">Poster un avis</h2>
        </div>

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />
        <div class="row justify-content-center p-2 p-lg-4">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header text-white mb-3">Racontez-nous votre expérience</div>

                    <div class="card-body">

                        <form @submit.prevent="sendData">

                            <div class="form-group row m-2">
                                <label for="note" class="col-md-4 col-form-label text-md-right">note</label>

                                <div class="col-md-6">
                                    <input v-model="note" id="note" type="number" min="1" max="10" class="form-control"
                                        name="note" required autocomplete="note" autofocus>
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="commentaire" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-md-6">
                                    <textarea v-model="commentaire" id="commentaire" class="form-control"
                                        name="commentaire" autocomplete="commentaire">
                                        commentaire (facultatif)</textarea>
                                </div>
                            </div>

                            <div class="form-group row mt-3 text-center">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="greenButton btn btn-lg rounded-pill text-light btn-info">
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

import { store } from "../store";
import ValidationErrors from "./ValidationErrors.vue"

export default {

    data() {
        return {
            note: "",
            commentaire: "",
            validationErrors: ""
        }
    },

    props: ['lieu_id'],

    components: { ValidationErrors },

    methods: {
        sendData() {
            axios.post('/api/avis', { note: this.note, commentaire: this.commentaire, lieu_id : this.lieu_id, user_id: store.state.userData.id })
                .then((response) => {
                    // on stocke le message de succès dans le store ("inscription réussie")
                    store.commit('storeMessage', response.data.message);
                    this.$router.push('/successmessage');
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        },
    }
}
</script>

<style scoped>
h2 {
    color: #1C6E8C
}

i {
    color: #94D1BE
}

.card-header {
    background-color: #94D1BE
}

.greenButton {
    color : white;
    background-color: #94D1BE;
}
</style>