//import Vuex from "vuex";

// // on importe createStore et on initialise le store
import { createStore } from 'vuex'
import VuexPersist from 'vuex-persist'

// vuex-persist permet de stocker le state dans le local storage
// => en cas d'actualisation de la page, on garde la connexion utilisateur
const vuexPersist = new VuexPersist({
    key: 'Nice_Places',
    storage: window.localStorage
})

const defaultState = {
    userData: {
        pseudo: "",
        email: "",
        id: "",
        departement: "",
        token: "",
        role: ""
    },
    message: "",
    geolocationAnswered: false,
    userPosition: "",
    lieux: "",
    threeTopPlaces: "",
    threeLastPlaces: "",
    categories: "",
    userPlaces: "",
    avis: "",
    users: "",
    images: "",
    favoris: "",
    notifications: ""
}

export const store = createStore({
    state() {
        if (localStorage.state) {
            return localStorage.state
        }
        else {
            return defaultState
        }
    },

    mutations: {
        // stocker les infos utilisateur dans le state
        storeUserData(state, payload) {
            state.userData.pseudo = payload.pseudo
            state.userData.email = payload.email
            state.userData.id = payload.id
            state.userData.departement = payload.departement
            state.userData.role = payload.role
            state.userData.token = payload.token
        },

        // stocker un message de succès dans le state
        storeMessage(state, payload) {
            state.message = payload
        },

        // mémoriser le fait qu'un choix a été fait par rapport à la géoloc
        storeGeolocationAnswered(state, payload) {
            state.geolocationAnswered = payload
        },

        // stocker la position de l'utilisateur si géoloc acceptée
        storeUserPosition(state, payload) {
            state.userPosition = payload
        },

        storeLieux(state, payload) {
            state.lieux = payload
        },

        storeUsers(state, payload) {
            state.users = payload
        },

        storeThreeTopPlaces(state, payload) {
            state.threeTopPlaces = payload
        },

        storeThreeLastPlaces(state, payload) {
            state.threeLastPlaces = payload
        },

        storeCategories(state, payload) {
            state.categories = payload
        },

        storeUserPlaces(state, payload) {
            state.userPlaces = payload
        },

        storeAvis(state, payload) {
            state.avis = payload
        },

        storeImages(state, payload) {
            state.images = payload
        },

        storeFavoris(state, payload) {
            state.favoris = payload
        },

        storeNotifications(state, payload) {
            state.notifications = payload
        },

        // réinitialiser le state
        resetState(state) {
            Object.assign(state, defaultState)
        }
    },

    getters: {
        // on récupère les lieux validés uniquement
        getValidatedPlaces(state) {
            return state.lieux.filter(lieu => lieu.statut == "validé")
        },

        // on récupère les lieux triés par note
        getTopRatedPlaces(state){
            console.log("on passe dans gettop");
            return state.lieux.sort((a, b) => {
                if (a.note > b.note) return -1;
                return a.note < b.note ? 1 : 0;
              });
        }
    },

    actions: {
        logOut() {
            store.commit("resetState")
        }
    },

    plugins: [vuexPersist.plugin]
})

