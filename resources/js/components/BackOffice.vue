<template>
    <div class="p-5">
        <i class="fa-solid fa-3x fa-wrench"></i>
        <h1 class="mt-2">Back-office</h1>
    </div>

    <section class="container-fluid p-3 p-lg-5">

        <!-- liste des avis -->
        <h2>Liste des avis</h2>

        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">utilisateur</th>
                        <th scope="col">lieu</th>
                        <th scope="col">note</th>
                        <th scope="col">commentaire</th>
                        <th scope="col">date de création</th>
                        <th scope="col">date de modification</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="avis in avis">
                        <th scope="row">{{ avis.id }}</th>
                        <td>{{ avis.user.pseudo }}</td>
                        <td>{{ avis.lieu.nom }}</td>
                        <td>{{ avis.note }}</td>
                        <td>{{ avis.commentaire.substring(0, 100) }}</td>
                        <td>{{ moment(avis.created_at).format("ddd MMM DD, YYYY [at] HH:mm a") }}</td>
                        <td> {{ avis.created_at == avis.updated_at ? "jamais modifié" :
                                moment(avis.updated_at).format("ddd MMM DD, YYYY [at] HH:mm a")
                        }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </section>

    <!-- liste des lieux -->




    <!-- liste des catégories -->

</template>

<script>
import { store } from "../store";
import moment from 'moment';
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
        }
    },

    methods: {

    }

}
</script>
