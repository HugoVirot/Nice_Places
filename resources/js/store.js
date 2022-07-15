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
    },
    message: "",
    geolocationAnswered: false,
    userPosition: "",
    lieux: "",
    threeTopPlaces: "",
    threeLastPlaces: "",
    categories: "",
    userPlaces: ""
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

        // réinitialiser le state
        resetState(state) {
            Object.assign(state, defaultState)
        }
    },

    getters: {
        getUserId(state) {
            return state.userData.id
        },

        getUserData(state) {
            return state.userData
        },

        getMessage(state) {
            return state.message
        },

        getThreeTopPlaces(state) {
            return state.threeTopPlaces
        },

        getThreeLastPlaces(state) {
            return state.threeLastPlaces
        },

        getCategories(state) {
            return state.categories
        }

    },

    actions: {
        logOut() {
            store.commit("resetState")
        }
    },

    plugins: [vuexPersist.plugin]
})

