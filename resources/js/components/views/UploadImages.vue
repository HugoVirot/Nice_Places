<template>

    <div class="pt-5 pb-2">
        <i class="mx-auto fa-3x fa-solid fa-paper-plane"></i>
        <h1 class="mt-2">Proposer une image</h1>
        <h2>{{ lieu.nom }}</h2>
    </div>

    <div class="container my-5" v-if="lieu.images && lieu.images.length > 0">
        <p class="mb-3">actuellement {{ lieu.images.length }} image(s) pour ce lieu</p>

        <div class="row my-2" v-if="lieu.images.length == 1">
            <div v-for="image in lieu.images" class="col-md-10 offset-md-1 my-1">
                <img class="previousPictures" :src="`/images/${image.nom}`" :alt="`${image.nom}`">
            </div>
        </div>

        <div class="row my-2" v-else>
            <div v-for="image in lieu.images" class="col-md-6 my-1">
                <img class="previousPictures" :src="`/images/${image.nom}`" :alt="`${image.nom}`">
            </div>
        </div>

    </div>

    <div class="container-fluid p-3 p-lg-5">

        <ValidationErrors :errors="validationErrors" v-if="validationErrors" />

        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Partagez votre plus belle photo !</div>

                    <div class="card-body">
                        <form @submit.prevent="sendData" enctype="multipart/form-data">

                            <div class="form-group row mx-2 mt-3">
                                <input required type="file" class="form-control-file col-md-8 offset-md-2"
                                    v-on:change="onChange">
                            </div>

                            <div class="form-group row mt-4 py-3 bg-white">
                                <div class="form-text mb-3 col-md-8 offset-md-2">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <i class="my-1 fa-3x fa-solid fa-weight-scale"></i>
                                            <p>Moins de 2 Mo</p>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <i class="my-1 fa-3x fa-solid fa-rectangle-list"></i>
                                            <p>Formats acceptés : JPG / JPEG, PNG et SVG</p>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <i class="my-1 fa-3x fa-solid fa-panorama"></i>
                                            <p>Uniquement en format paysage svp</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mt-3 text-center">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-lg rounded-pill text-light">
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
import axios from "axios";
import ValidationErrors from "../utilities/ValidationErrors.vue"
import { useUserStore } from "../../stores/userStore";
import { mapState } from "pinia";

export default {

    computed: {
        ...mapState(useUserStore, ['id'])
    },

    data() {
        return {
            lieuId: this.$route.params.id,
            lieu: '',
            formData: new FormData(),
            validationErrors: ''
        }
    },

    components: { ValidationErrors },

    methods: {
        onChange(e) {
            let imageChoisie = e.target.files[0]
            console.log(imageChoisie)
            this.formData.append('image', imageChoisie)
            console.log(this.formData)
        },

        sendData() {
            // on ajoute le user id et le lieu id au formulaire
            this.formData.append("user_id", this.id);
            this.formData.append("lieu_id", this.lieuId);
            this.formData.append("nom_lieu", this.lieu.nom);

            // on envoie le tout à l'api
            axios.post('/api/images', this.formData, { 'content-type': 'multipart/form-data' })
                .then((response) => {
                    let message = response.data.message
                    // on redirige vers l'accueil
                    this.$router.push('/SuccessMessage/home/' + message)
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.data;
                })
        }
    },

    created() {
        axios.get("/api/lieus/" + this.lieuId)
            .then(response => {
                this.lieu = response.data
            })
            .catch((error) => {
                console.log(error)
            });
    }
}
</script>

<style scoped>
h1,
h2 {
    color: #1C6E8C
}

i {
    color: #94D1BE
}

.container-fluid {
    background-image: url(../../../../public/images/lake.jpg);
    background-position: center;
    background-size: cover;
}

.card {
    color: #1C6E8C;
    background: rgba(254, 254, 254, 0.73)
}

.card-header {
    background-color: #94D1BE
}

.btn {
    background-color: #94D1BE !important;
    color: white;
}

.previousPictures {
    max-height: 100%;
    max-width: 100%
}
</style>