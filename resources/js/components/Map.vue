
<template>
    <div id="map"></div>
</template>

<script>
import axios from "axios";
import { store } from "../store.js";

// import Vue from 'vue';
// window.Vue = Vue;
// import router from '../router.js';
// Vue.router = router;

export default {

    computed: {
        userPosition() {
            return store.state.userPosition
        },
        geolocationAnswered() {
            return store.state.geolocationAnswered
        },
        lieux() {
            if (store.state.lieux) {
                return store.getters.getValidatedPlaces
            }
        }
    },

    data() {
        return {
            map: ""
        }
    },

    props: ["lieuSeul"],

    methods: {
        initializeMap(component) {

            // ******************* si page détails => affichage d'un seul lieu (pas de pointeur user pour le moment, confusion) *****************
            if (component.lieuSeul) {

                const latitude = component.lieuSeul.latitude
                const longitude = component.lieuSeul.longitude

                component.map = L.map('map').setView([latitude, longitude], 13);

                // pour pouvoir ajouter des tuiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(component.map);

                L.marker([latitude, longitude]).addTo(component.map)

            } else {

                // **************** si le user a accepté la géoloc => on crée une map avec son emplacement *****************
                if (this.userPosition) {
                    console.log("géoloc déjà acceptée, coordonnées déjà stockées dans le state")

                    component.map = L.map('map').setView([this.userPosition.latitude, this.userPosition.longitude], 13);

                    // pour pouvoir ajouter des tuiles
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(component.map);

                    // création du pointeur indiquant la position de l'utilisateur
                    L.marker([this.userPosition.latitude, this.userPosition.longitude]).addTo(component.map);


                    // **** si le user n'a pas accepté la géoloc => on crée une map avec un emplacement par défaut (Paris) ****
                } else {

                    component.map = L.map('map').setView([48.8534100, 2.3488000], 13);

                    // pour pouvoir ajouter des tuiles
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(component.map);
                }

                // *************************** ajouter les pointeurs des lieux à la map *******************************


                // on ajoute un pointeur par lieu à la map
                if (component.lieux) {
                    component.lieux.forEach(lieu => {

                        // function redirectOnPlace() {
                        //     component.$router.push('/inscription')
                        // }

                        var popupContent = "<h5 style=\"color: #1C6E8C; font-family:'Cooper'\">" + lieu.nom +
                            "<i class=\"fa-solid fa-star ms-3 me-2 mt-1\" style=\"color: yellow\"></i>" + lieu.note + "</h5>" +

                            // lieu.categories.forEach(category => { console.log(category.icone) }) + // impossible d'afficher les icônes des catégories
                            // tests : document.write, concaténation

                            "<img class=\"mx-auto\" src=\"images/" + lieu.image_mise_en_avant.nom + "\" style=\"width: 30vw\">" +

                            "<p style=\"font-family:'Cooper'\" class=\"text-center\">" + lieu.adresse + "<br>" + lieu.code_postal + " " + lieu.ville + "</p>"

                        // `<router-link to="/lieu/${lieu.id}">` + 
                        // "<button class=\"btn moreInfoButton mx-auto\" id=\"" + lieu.id + "\" style=\"color:white; background-color: #94D1BE\">plus d'infos</button>" +
                        // "</router-link>"

                        // ne marche pas (component (ou $router) in undefined)
                        // "<a target=\"_self\" onclick=\"component.$router.push(`/lieu/${lieu.id}`)\">plus d'infos</a>"
                        // `<a id=\""${lieu.id}"\" href =\"/lieu/${lieu.id}\" target = \"_self\" onclick = \"event.preventDefault(); Vue.router.push('/lieu/${lieu.id}')\"> Plus d'infos</a>`

                        // "<a target=\"_self\" class=\"popupLink\" onclick=\"component.redirectOnPlace()\">plus d'infos</a>"


                        var popupOptions =
                        {
                            'maxWidth': '30vw',
                            'className': 'popupLieu'
                        }

                        //ne marche pas
                        let marker = L.marker([lieu.latitude, lieu.longitude]).addTo(component.map)
                            .bindPopup(popupContent, popupOptions)

                        // marker.on('popupopen', function (e) {

                        //     e.popup.on("click", () => alert("hello"))
                        // });

                        // marker._icon.classList.add("huechange"); //  + img.huechange { filter: hue-rotate(120deg); } => ne marchent pas
                    })
                }
            }
        }
    },

    created() {
        // si les lieux ne sont pas encore récupérés, on va les chercher
        if (!this.lieux) {
            axios.get("/api/lieus")
                .then(response => {

                    const lieux = response.data

                    // on stocke les lieux dans le state
                    store.commit("storeLieux", lieux)

                }).catch(response => console.log(response.error))
        }
    },

    mounted: function () {

        // *************ne marche pas******************

        // let moreInfosButtons = document.getElementsByClassName("popupLieu")

        // console.log(moreInfosButtons)

        // for (let i = 0; i < moreInfosButtons.length; i++) {
        //     moreInfosButtons[i].addEventListener('click', (button) => console.log(button.id));
        // }


        // *********************si géolocalisation pas déjà demandée***********************
        if (!this.geolocationAnswered) {

            // ************************ on la demande ************************

            // si le navigateur supporte la géolocalisation (pas dispo sur les + anciens)
            if (navigator.geolocation) {

                // on demande l'accès à la position via une petite fenêtre 
                // si accepté, on stocke les coordonnées de l'utilisateur dans le state
                navigator.geolocation.getCurrentPosition(position => {
                    console.log(position.coords)
                    store.commit('storeGeolocationAnswered', true)
                    store.commit('storeUserPosition', { latitude: position.coords.latitude, longitude: position.coords.longitude })
                    console.log("accès position accepté, choix et coordonnées stockés dans le state")
                    this.initializeMap(this)
                    // si accès refusé, on stocke cela dans le state et on l'affiche dans la console
                }, () => {
                    store.commit('storeGeolocationAnswered', true)
                    console.log("accès à la position refusé, choix stocké dans le state")
                    this.initializeMap(this)
                }
                )
            } else {
                alert("La géolocalisation est indisponible sur votre navigateur")
                this.initializeMap(this)
            }

            // *********************si géolocalisation déjà demandée***********************

        } else {

            // *************** on initialise la map *****************
            this.initializeMap(this)
        }
    }
}
</script>

<style scoped>
#map {
    height: 75vh;
    margin: auto;
}
</style>


<!-- document.getElementById('#map').on('popupopen', function() {
    console.log(testing);    
}); -->