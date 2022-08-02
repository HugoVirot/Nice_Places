<template>
    <div class="p-5">
        <i class="bigIcon fa-solid fa-3x fa-wrench"></i>
        <h1 class="mt-2">Back-office</h1>
    </div>


    <div class="container mb-4">
        <div class="row">
            <div @click="showLieux = !showLieux" class="col-6 col-lg-4 py-5 border border-secondary">
                <i class="bigIcon fa-3x fa-solid fa-map-location-dot"></i>
                <h2>Lieux</h2>
            </div>
            <div @click="showCategories = !showCategories" class="col-6 col-lg-4 py-5 border border-secondary">
                <i class="bigIcon fa-solid fa-3x fa-rectangle-list"></i>
                <h2>Catégories</h2>
            </div>
            <div @click="showAvis = !showAvis" class="col-6 col-lg-4  py-5 border border-secondary">
                <i class="bigIcon fa-solid fa-3x fa-pen"></i>
                <h2>Avis</h2>
            </div>
            <div @click="showUsers = !showUsers" class="col-6 col-lg-4 py-5 border border-secondary">
                <i class="bigIcon fa-solid fa-3x fa-user"></i>
                <h2>Utilisateurs</h2>
            </div>
            <div @click="showImages = !showImages" class="col-6 col-lg-4 py-5 border border-secondary">
                <i class="bigIcon fa-3x fa-solid fa-camera"></i>
                <h2>Images</h2>
            </div>
        </div>
    </div>

    <section v-if="showLieux" class="container-fluid">

        <h2 class="mb-2">Liste des lieux</h2>

        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">nom</th>
                    <th scope="col">modifier</th>
                    <th scope="col">supprimer</th>
                    <th scope="col">description</th>
                    <th scope="col">latitude</th>
                    <th scope="col">longitude</th>
                    <th scope="col">note</th>
                    <th scope="col">temps</th>
                    <th scope="col">difficulté</th>
                    <th scope="col">kilomètres</th>
                    <th scope="col">adresse</th>
                    <th scope="col">code postal</th>
                    <th scope="col">ville</th>
                    <th scope="col">posté par</th>
                    <th scope="col">validé</th>
                    <th scope="col">ajouté le</th>
                    <th scope="col">modifié le</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="lieu in lieux">
                    <th scope="row">{{ lieu.id }}</th>
                    <td>{{ lieu.nom }}</td>
                    <td>
                        <router-link :to="`/modifierlieu/${lieu.id}`"><i class="fa-solid fa-pen-to-square"></i>
                        </router-link>
                    </td>
                    <td><i class="fa-solid fa-eraser" @click="deleteLieu(lieu.id)"></i></td>
                    <td>{{ lieu.description.substring(0, 100) }}</td>
                    <td>{{ lieu.latitude }}</td>
                    <td>{{ lieu.longitude }}</td>
                    <td>{{ lieu.note }}</td>
                    <td>{{ lieu.temps }}</td>
                    <td>{{ lieu.difficulte }}</td>
                    <td>{{ lieu.kilometres }}</td>
                    <td>{{ lieu.adresse }}</td>
                    <td>{{ lieu.code_postal }}</td>
                    <td>{{ lieu.ville }}</td>
                    <td>{{ lieu.user.pseudo }}</td>

                    <td v-if="lieu.statut == 'validé'" class="bg-success text-white">validé</td>
                    <td v-else-if="lieu.statut == 'en attente'" class="mx-auto bg-info w-25">en attente de validation
                    </td>
                    <td v-else-if="lieu.statut == 'à modifier'" class="mx-auto bg-warning w-25">à modifier pour être validé
                    </td>
                    <td v-else class="mx-auto bg-danger w-25">refusé</td>

                    <td>{{ moment(lieu.created_at).format("ddd DD MMM YYYY [à] HH:mm") }}</td>
                    <td> {{ lieu.created_at == lieu.updated_at ? "jamais modifié" :
                            moment(avis.updated_at).format("ddd DD MMM YYYY [à] HH:mm")
                    }}</td>
                </tr>

            </tbody>
        </table>
    </section>

    <section v-if="showCategories" class="container-fluid p-3 p-lg-5">

        <h2 class="mb-2">Liste des catégories</h2>

        <div class="container">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nom</th>
                        <th scope="col">icône</th>
                        <th scope="col">ajoutée le</th>
                        <th scope="col">modifiée le</th>
                        <th scope="col">modifier</th>
                        <th scope="col">supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="categorie in categories">
                        <th scope="row">{{ categorie.id }}</th>
                        <td>{{ categorie.nom }}</td>
                        <td>{{ categorie.icone }}</td>
                        <td>{{ moment(categorie.created_at).format("ddd DD MMM YYYY [à] HH:mm") }}</td>
                        <td> {{ categorie.created_at == categorie.updated_at ? "jamais modifié" :
                                moment(categorie.updated_at).format("ddd DD MMM YYYY [à] HH:mm")
                        }}</td>
                        <td>
                            <router-link :to="`/modifiercategorie/${categorie.id}`"><i
                                    class="fa-solid fa-pen-to-square"></i>
                            </router-link>
                        </td>
                        <td><i class="fa-solid fa-eraser" @click="deleteCategory(categorie.id)"></i></td>
                    </tr>

                </tbody>
            </table>
        </div>

        <h2>Ajouter une catégorie</h2>

        <div class="row justify-content-center p-2 p-lg-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white mb-3">Entrez ici vos informations</div>

                    <div class="card-body">

                        <form @submit.prevent="storeCategory">

                            <div class="form-group row m-2">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">nom</label>

                                <div class="col-md-6">
                                    <input v-model="nom" id="nom" type="text" class="form-control" name="nom" required
                                        autocomplete="nom">
                                </div>
                            </div>

                            <div class="form-group row m-2">
                                <label for="icone" class="col-md-4 col-form-label text-md-right">icône</label>

                                <div class="col-md-6">
                                    <input v-model="icone" id="icone" type="text" class="form-control" name="icone"
                                        required autocomplete="icone">
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

    </section>

    <section v-if="showAvis" class="container-fluid p-3 p-lg-5">

        <h2 class="mb-2">Liste des avis</h2>

        <div class="container">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">utilisateur</th>
                        <th scope="col">lieu</th>
                        <th scope="col">note</th>
                        <th scope="col">commentaire</th>
                        <th scope="col">date de création</th>
                        <th scope="col">date de modification</th>
                        <th scope="col">modifier</th>
                        <th scope="col">supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="avis in avis">
                        <th scope="row">{{ avis.id }}</th>
                        <td>{{ avis.user.pseudo }}</td>
                        <td>{{ avis.lieu.nom }}</td>
                        <td>{{ avis.note }}</td>
                        <td v-if="avis.commentaire">{{ avis.commentaire.substring(0, 60) }}</td>
                        <td v-else>aucun</td>
                        <td>{{ moment(avis.created_at).format("ddd DD MMM YYYY [à] HH:mm") }}</td>
                        <td> {{ avis.created_at == avis.updated_at ? "jamais modifié" :
                                moment(avis.updated_at).format("ddd DD MMM YYYY [à] HH:mm")
                        }}</td>
                        <td>
                            <router-link :to="`/modifieravis/${avis.id}`"><i class="fa-solid fa-pen-to-square"></i>
                            </router-link>
                        </td>
                        <td><i class="fa-solid fa-eraser" @click="deleteReview(avis.id)"></i></td>
                    </tr>

                </tbody>
            </table>
        </div>

    </section>

    <section v-if="showUsers" class="container-fluid p-3 p-lg-5">

        <h2 class="mb-2">Liste des utilisateurs</h2>

        <div class="container">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">pseudo</th>
                        <th scope="col">email</th>
                        <th scope="col">role</th>
                        <th scope="col">inscrit le</th>
                        <th scope="col">modifié le</th>
                        <th scope="col">supprimer le compte</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <th scope="row">{{ user.id }}</th>
                        <td>{{ user.pseudo }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role.role }}</td>
                        <td>{{ moment(user.created_at).format("ddd DD MMM YYYY [à] HH:mm") }}</td>
                        <td> {{ user.created_at == user.updated_at ? "jamais modifié" :
                                moment(user.updated_at).format("ddd DD MMM YYYY [à] HH:mm")
                        }}</td>
                        <td><i class="fa-solid fa-eraser" @click="deleteUser(user.id)"></i></td>
                    </tr>

                </tbody>
            </table>
        </div>

    </section>

    <section v-if="showImages" class="container-fluid  p-3 p-lg-5">
        <h2 class="mb-2">Liste des images</h2>

        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">aperçu</th>
                    <th scope="col">id</th>
                    <th scope="col">nom</th>
                    <th scope="col">postée par</th>
                    <th scope="col">mise en avant</th>
                    <th scope="col">longueur</th>
                    <th scope="col">largeur</th>
                    <th scope="col">taille</th>
                    <th scope="col">ajoutée le</th>
                    <th scope="col">modifier</th>
                    <th scope="col">supprimer</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="image in images">
                    <th>
                        <button class="m-3" data-bs-toggle="modal" :data-bs-target="`.imageZoom${image.id}`"
                            style="border: none; outline:none">
                            <img class="w-75" :src="`/images/${image.nom}`" :alt="`${image.nom}`">
                        </button>
                    </th>
                    <th>{{ image.id }}</th>
                    <td>{{ image.nom }}</td>
                    <td>{{ image.user.pseudo }}</td>
                    <td>{{ image.mise_en_avant ? 'oui' : 'non' }}</td>
                    <td>{{ image.longueur }} px</td>
                    <td>{{ image.largeur }} px</td>
                    <td>{{ image.taille }} kb</td>
                    <td>{{ moment(image.created_at).format("ddd DD MMM YYYY [à] HH:mm") }}</td>
                    <td>
                        <router-link :to="`/modifierimage/${image.id}`"><i class="fa-solid fa-pen-to-square"></i>
                        </router-link>
                    </td>
                    <td><i class="fa-solid fa-eraser" @click="deleteImage(image.id)"></i></td>

                    <!-- modal pour afficher l'image en grand -->
                    <div :class="`modal fade imageZoom${image.id}`" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-body w-100">
                                <img class="w-100" :src="`/images/${image.nom}`" :alt="`${image.nom}`">
                            </div>
                        </div>
                    </div>
                </tr>
            </tbody>
        </table>
    </section>

</template>

<script>
import { store } from "../store";
import moment from 'moment';
import axios from "axios";
moment.locale('fr');

export default {
    // computed permet de surveiller automatiquement les changements
    // des variables dans le state => automatiquement à jour en cas
    // d'ajout / suppression / modif de lieu et/ou de catégorie
    computed: {
        avis() {
            return store.state.avis
        },
        lieux() {
            return store.state.lieux
        },
        categories() {
            return store.state.categories
        },
        users() {
            return store.state.users
        },
        images() {
            return store.state.images
        },
        // lieuxNonValidés()[
        //     return store.state.lieux.filter( lieu => lieu.valide)

        // ]
    },

    data() {
        return {
            nom: "",
            icone: "",
            showUsers: false,
            showLieux: false,
            showCategories: false,
            showAvis: false,
            showImages: false
        }
    },

    methods: {

        deleteReview(id) {

            axios.delete("/api/avis/" + id)

                .then(response => {
                    console.log(response)
                    store.commit('storeMessage', response.data.message)
                    console.log(store.state.message)

                    // on va récupérer la nouvelle liste des avis
                    axios.get('/api/avis')

                        .then(response => {
                            store.commit("storeAvis", response.data)
                            // on redirige vers l'accueil en affichant le message de succès
                            this.$router.push('/SuccessMessage')
                        })

                        .catch(error => {
                            console.log(error.response)
                        })

                })

                .catch(error => {
                    console.log(error.response)
                })
        },

        editLieu(id) {
            console.log("modification lieu d'id " + id)
        },

        deleteLieu(id) {

            axios.delete("/api/lieus/" + id)
                .then(response => {
                    // on stocke le message de succès dans le store pour l'afficher juste après
                    store.commit('storeMessage', response.data.message)
                    console.log(store.state.message)

                    // on va récupérer la nouvelle liste des lieux
                    axios.get('/api/lieus')
                        .then(response => {
                            store.commit("storeLieux", response.data)
                            console.log(this.lieux)
                            // on redirige vers l'accueil en affichant le message de succès
                            this.$router.push('/SuccessMessage')
                        })
                        .catch(error => {
                            console.log(error.response)
                        })
                })

                .catch(error => {
                    console.log(error.response)
                })
        },

        editCategory(id) {
            console.log("modification lieu d'id " + id)
        },

        deleteCategory(id) {

            console.log("suppression categorie d'id " + id)
            axios.delete("/api/categories/" + id)

                .then(response => {
                    // on stocke le message de succès dans le store pour l'afficher juste après
                    store.commit('storeMessage', response.data.message)
                    console.log(store.state.message)

                    // on va récupérer la nouvelle liste des lieux
                    axios.get('/api/categories')

                        .then(response => {
                            store.commit("storeCategories", response.data)
                            console.log(this.categories)
                            // on redirige vers l'accueil en affichant le message de succès
                            this.$router.push('/SuccessMessage')
                        })

                        .catch(error => {
                            console.log(error.response)
                        })

                })

                .catch(error => {
                    console.log(error.response)
                })
        },

        storeCategory() {
            axios.post('/api/categories', { nom: this.nom, icone: this.icone })
                .then(response => {
                    // on stocke le message de succès dans le store pour l'afficher juste après
                    store.commit('storeMessage', response.data.message)
                    console.log(store.state.message)

                    // on va récupérer la nouvelle liste des lieux
                    axios.get('/api/categories')

                        .then(response => {
                            store.commit("storeCategories", response.data)
                            console.log(this.categories)
                            // on redirige vers l'accueil en affichant le message de succès
                            this.$router.push('/SuccessMessage')
                        })

                        .catch(error => {
                            console.log(error.response)
                        })

                })

                .catch(error => {
                    console.log(error.response)
                })
        },

        deleteUser(id) {

            console.log("suppression user d'id " + id)
            axios.delete("/api/users/" + id)

                .then(response => {
                    // on stocke le message de succès dans le store pour l'afficher juste après
                    store.commit('storeMessage', response.data.message)
                    console.log(store.state.message)

                    // on va récupérer la nouvelle liste des lieux
                    axios.get('/api/users')

                        .then(response => {
                            store.commit("storeUsers", response.data)
                            console.log(this.users)
                            // on redirige vers l'accueil en affichant le message de succès
                            this.$router.push('/SuccessMessage')
                        })

                        .catch(error => {
                            console.log(error.response)
                        })

                })

                .catch(error => {
                    console.log(error.response)
                })
        },

        deleteImage(id) {

            console.log("suppression image d'id " + id)
            axios.delete("/api/images/" + id)

                .then(response => {
                    // on stocke le message de succès dans le store pour l'afficher juste après
                    store.commit('storeMessage', response.data.message)
                    console.log(store.state.message)

                    // on va récupérer la nouvelle liste des lieux
                    axios.get('/api/images')

                        .then(response => {
                            store.commit("storeImages", response.data)
                            console.log(this.images)
                            // on redirige vers l'accueil en affichant le message de succès
                            this.$router.push('/SuccessMessage')
                        })

                        .catch(error => {
                            console.log(error.response)
                        })

                })

                .catch(error => {
                    console.log(error.response)
                })
        },
    },

    created() {
        this.moment = moment

        axios.get("http://localhost:8000/api/avis")
            .then(response => {
                store.commit('storeAvis', response.data)
                console.log(this.avis)
            }
            )
            .catch(error => {
                console.log(error.response)
            })


        axios.get("http://localhost:8000/api/users")
            .then(response => {
                store.commit('storeUsers', response.data)
                console.log(this.users)
            }
            )
            .catch(error => {
                console.log(error.response)
            })


        axios.get("http://localhost:8000/api/images")
            .then(response => {
                store.commit('storeImages', response.data)
                console.log(this.images)
            }
            )
            .catch(error => {
                console.log(error.response)
            })


        // let models = ['users', 'avis', 'categories', 'lieux']

        // models.forEach(model => {

        //     if (!this.model) {

        //         if (model === 'lieux') {
        //             model = 'lieus'
        //         }

        //         axios.get('/api/' + model)
        //             .then(response => {
        //                 let model = model.charAt(0).toUpperCase() + model.slice(1);
        //                 let mutatorName = "store" + model
        //                 console.log(mutatorName)
        //                 store.commit(mutatorName, response.data)
        //                 console.log(model + " récupéré")
        //             })
        //             .catch(error => {
        //                 console.log(error.response)
        //             })
        //     }
        // })
    }
}
</script>

<style scoped>
h1,
h2,
i {
    color: #1c6e8c
}

.bigIcon {
    color: #94D1BE
}

@media screen and (max-width: 1200px) {
    img {
        width: 30vw !important
    }
}
</style>