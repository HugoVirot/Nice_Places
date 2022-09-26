import { defineStore } from 'pinia'

export const useUserStore = defineStore({
    // id requis pour connecter le store aux devtools
    id: 'UserStore',

    state: () => {
        return {
            pseudo: "",
            email: "",
            id: "",
            departement: "",
            token: "",
            role: "",
            userLoggedIn: false,
            geolocationAnswered: false,
            userPosition: "",
            userPlaces: "",
            favoris: "",
            notifications: ""
        }
    },

    getters: {
        // retourne le nombre de notifications non lues
        countUnreadNotifications() {
            if (this.notifications) {
                return this.notifications.filter(n => !n.lue).length
            }
            else {
                return null
            }

        }

    },

    actions: {
        storeUserData(userData) {
            this.pseudo = userData.pseudo
            this.email = userData.email
            this.id = userData.id
            this.departement = userData.departement
            this.region = userData.departement.region.nom
            this.role = userData.role
            this.token = userData.token
            this.userLoggedIn = true
        },

        // mémoriser le fait qu'un choix a été fait par rapport à la géoloc
        storeGeolocationAnswered(answer) {
            this.geolocationAnswered = answer
        },

        // stocker la position de l'utilisateur si géoloc acceptée
        storeUserPosition(userCoordinates) {
            this.userPosition = userCoordinates
        },

        storeNotifications(notifications){
            this.notifications = notifications
        },

        storeUserPlaces(userPlaces){
            this.userPlaces = userPlaces
        },

        storeFavoris(favoris){
            this.favoris = favoris
        }
    },

    persist: true, // activation du plugin de persistance
})