<script>
import { store } from '../store'

export default {

    data() {
        return {
            topLieux: store.getters.getTopRatedPlaces,
            departementUtilisateur: store.state.userData.departement,
            departementFiltre: '',
            filtre: "france",
            departements: store.state.departements
        }
    },


    // on surveille le filtre. Si changement => 
    // 1) choix du département de l'utilisateur : on filtre les lieux par département de l'utilisateur
    // 2) choix de toute la France ou d'un autre département : on récupère tous les lieux (selon le filtre choisi)
    watch: {
        filtre(newFilter) {

            if (newFilter == "departementUtilisateur") {
                this.topLieux = store.getters.getPlacesByDepartment
            } else {
                this.topLieux = store.getters.getTopRatedPlaces
            }
        },

        // en cas de choix d'un autre département parmi la liste, on surveille cet évènement ici
        // on déclenche le filtrage de tous les lieux (qu'on récupère dans le store) selon ce département
        // la récupération permet de bien repartir de la liste de tous les lieux au cas où on changerait de département
        // sans changer de filtre (on ne repasserait donc pas par la fonction filtre ci-dessus)
        departementFiltre(newDepartement) {

            console.log(newDepartement)
            let allPlaces = store.getters.getTopRatedPlaces
            this.topLieux = allPlaces.filter(lieu => lieu.departement.code == newDepartement)
        }
    },

    created() {
        console.log(this.topLieux);
    }
}
</script>

<template>
    <section id="topLieux" class="p-2 text-secondary">
        <div class="p-3">
            <i class="greenIcon mx-auto fa-3x fa-solid fa-message"></i>
            <h1 class="mt-2">Top 100 des lieux</h1>
        </div>

        <p>Afficher les lieux : </p>

        <select required v-model="filtre" class="form-select w-50 mx-auto" aria-label="filtre">
            <option value="france">de la France entière</option>
            <!-- disponible uniquement si le département de l'utilisateur a déjà été renseigné -->
            <option v-if="departementUtilisateur" value="departementUtilisateur">de votre département</option>
            <option value="autreDepartement">d'un autre département</option>
        </select>

        <div v-if="filtre == 'autreDepartement'">
            <label class="m-3" for="departmentSelect">Choisissez un département</label>
            <select id="departmentSelect" required v-model="departementFiltre" class="form-select w-50 mx-auto"
                aria-label="filtre">
                <option v-for="(departement, index) in departements" :selected="index == 0" :value="departement.code">{{
                        departement.code
                }} - {{ departement.nom }}</option>
            </select>
        </div>

        <div class="container-fluid p-3 p-lg-5">

            <div v-if="topLieux" class="row">

                <div v-if="topLieux.length > 0" class="col-lg-6 border border-3 border-white card text-white textWithShadow"
                    v-for="(topLieu, index) in topLieux" :key="topLieu.id"
                    :style="`background-image: url(images/${topLieu.image_mise_en_avant.nom}); background-position: center; background-size: cover;`">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <span class="ranking">#{{ index + 1 }}</span>
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <p><i class="yellowStar fa-2x fa-solid fa-star ms-2 me-1"></i>
                                <span class="fs-2">{{ topLieu.note }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="p-3 fs-3"> {{ topLieu.nom }} </div>
                    <div class="card-body">
                        <router-link :to="`/lieu/${topLieu.id}`"><button class="btn greenButton">Détails du
                                lieu</button>
                        </router-link>
                    </div>
                </div>

                <div v-else>
                    <p>Aucun lieu de ce département dans le top 100.</p>
                </div>

            </div>

            <div v-else>
                <p>chargement en cours...</p>
            </div>

        </div>
    </section>
</template>

<style scoped>
.textWithShadow {
    text-shadow: 2px 2px 4px #1C6E8C;
}

.greenIcon {
    color: #94DEB1
}

.greenBackground {
    background-color: #94DEB1;
}

.ranking {
    font-size: 4em;
}

h1 {
    color: #1C6E8C
}

.yellowStar {
    color: yellow
}

.textWithShadow {
    text-shadow: 2px 2px 4px #1C6E8C;
}

.greenButton {
    color: white;
    background-color: #94D1BE;
}
</style>