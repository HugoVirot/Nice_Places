<template>

    <div class="pt-5 pb-2">
        <i class="mx-auto fa-3x greenIcon fa-solid fa-paper-plane"></i>
        <h1 class="mt-2">Mes lieux postés</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">
        <div class="row">
            <div v-if="userPlaces.length == 0"><i class="greenIcon fa-solid fa-xmark fa-5x"></i>
                <p>Vous n'avez posté aucun lieu</p>
                <router-link to="/proposerlieu"><button class="btn btn-lg mt-3 greenButton rounded-pill">Proposer un lieu</button>
                </router-link>
            </div>
            <div v-else class="col-lg-6 border border-3 border-white card card35vh text-white"
                v-for="(userPlace, index) in userPlaces" :key="userPlace.id" :style="`background-image: url(images/${
                userPlace.image_mise_en_avant[0] ?  userPlace.image_mise_en_avant[0].nom : 'placeholder.png'
                }); background-position: center; background-size: cover;`">
                <div class="p-3 fs-3 textWithShadow"> {{ userPlace.nom }} </div>
                <div v-if="userPlace.statut == 'validé'" class="mx-auto bg-success w-25">validé</div>
                <div v-else-if="userPlace.statut == 'en attente'" class="mx-auto bg-info w-25">en attente de validation
                </div>
                <div v-else-if="userPlace.statut == 'à modifier'" class="mx-auto bg-warning w-25">à modifier pour être
                    validé
                </div>
                <div v-else class="mx-auto bg-danger w-25">refusé
                </div>
                <div class="card-body">
                    <router-link :to="`/lieu/${userPlace.id}`"><button class="btn greenButton me-2">Détails du lieu</button>
                    </router-link>
                    <router-link :to="`modifierLieu/${userPlace.id}`"><button class="btn blueButton">Modifier lieu</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { useUserStore } from "../../stores/userStore";
import { mapState } from "pinia";
import { mapActions } from "pinia";

export default {

    computed: {
        ...mapState(useUserStore, ['id', 'userPlaces'])
    },

    methods: {

        ...mapActions(useUserStore, ['storeUserPlaces']),

        // on récupère les lieux postes par le user
        getLieuxPostes() {
            axios.post("http://localhost:8000/api/lieus/getplacesbyuser", null, {
                params: {
                    user_id: this.id
                }
            })
                .then(response => this.storeUserPlaces(response.data))
                .catch(() => { // message d'erreur pour l'utilisateur en cas d'échec de l'appel API
                    alert("Une erreur s'est produite. Certains éléments peuvent ne pas être affichés. Vous pouvez essayer de recharger la page pour corriger le problème.")
                })
        },
    },

    created() {
        // on récupère les lieux postés par l'utilisateur
        this.getLieuxPostes()
    }
}
</script>
