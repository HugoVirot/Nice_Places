// // on importe createStore et on initialise le store
import { createStore } from 'vuex'
import VuexPersist from 'vuex-persist'

// vuex-persist permet de stocker le state dans le local storage
// => en cas d'actualisation de la page, on garde la connexion utilisateur et toutes
// les informations contenues dans le state
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
    userLoggedIn: false,
    geolocationAnswered: false,
    userPosition: "",
    lieux: "",
    departements: "",
    regions: "",
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
            console.log("storeuserdata");
            state.userData.pseudo = payload.pseudo
            state.userData.email = payload.email
            state.userData.id = payload.id
            state.userData.departement = payload.departement
            state.userData.region = payload.departement.region.nom
            state.userData.role = payload.role
            state.userData.token = payload.token
        },

        // mémoriser le fait que l'utilisateur soit connecté
        storeUserLoggedIn(state) {
            console.log("userloggedin");
            state.userLoggedIn = true
        },

        // mémoriser le fait qu'un choix a été fait par rapport à la géoloc
        storeGeolocationAnswered(state, payload) {
            state.geolocationAnswered = payload
        },

        // stocker la position de l'utilisateur si géoloc acceptée
        storeUserPosition(state, payload) {
            state.userPosition = payload
        },

        storeNewLieu(state, payload) {
            console.log("storeNewLieu");
            state.lieux.push(payload)
        },

        storeLieux(state, payload) {
            console.log("storeLieux");
            state.lieux = payload
        },

        storeDepartements(state, payload) {
            state.departements = payload
        },

        storeRegions(state, payload) {
            state.regions = payload
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

        // on récupère les 100 meilleurs lieux (triés par note)
        getTopRatedPlaces(state) {
            return state.lieux.slice(0, 100).sort((a, b) => {
                if (a.note > b.note) return -1;
                return a.note < b.note ? 1 : 0;
            });
        }
    },

    actions: {
        saveUserData({ commit }, payload) {
            commit('storeUserData', payload)
        },
        saveLieux({ commit }, payload) {
            commit('storeLieux', payload)
        }
    },

    plugins: [vuexPersist.plugin]
})

