
<template>
    <div id="map"></div>
</template>

<script>
import axios from "axios";
import { store } from "../store.js";

export default {

    computed: {
        userPosition() {
            return store.state.userPosition
        },
        geolocationAnswered() {
            return store.state.geolocationAnswered
        }
    },

    data() {
        return {
            map: ""
        }
    },

    methods: {
        initializeMap(component) {

            // ********* si le user a accepté la géoloc => on crée une map avec son emplacement ***********
            if (this.userPosition) {
                console.log("géoloc déjà acceptée, coordonnées déjà stockées dans le state")

                this.map = L.map('map').setView([this.userPosition.latitude, this.userPosition.longitude], 13);

                // pour pouvoir ajouter des tuiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(this.map);

                // création du pointeur indiquant la position de l'utilisateur
                L.marker([this.userPosition.latitude, this.userPosition.longitude]).addTo(this.map);


                // **** si le user n'a pas accepté la géoloc => on crée une map avec un emplacement par défaut (Paris) ****
            } else {
                this.map = L.map('map').setView([48.8534100, 2.3488000], 13);

                // pour pouvoir ajouter des tuiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(this.map);
            }


            // ajouter les pointeurs des lieux à la map
            axios.get("/api/lieus")
                .then(response => {

                    const lieux = response.data

                    // on stocke les lieux dans le state
                    store.commit("storeLieux", lieux)

                    // on ajoute un pointeur par lieu à la map
                    lieux.forEach(lieu => {

                        function redirectOnPlace() {
                            component.$router.push('/inscription')
                        }

                        var popupContent = "<h5 style=\"color: #1C6E8C; font-family:'Cooper'\">" + lieu.nom +
                            "<i class=\"fa-solid fa-star ms-3 me-2 mt-1\" style=\"color: yellow\"></i>" + lieu.note + "</h5>" +

                            // lieu.categories.forEach(category => { console.log(category.icone) }) + // impossible d'afficher les icônes des catégories
                            // tests : document.write, concaténation

                            "<img class=\"mx-auto\" src=\"images/" + lieu.images[0].nom + "\" style=\"width: 30vw\">" +

                            "<p style=\"font-family:'Cooper'\" class=\"text-center\">" + lieu.adresse + "<br>" + lieu.code_postal + " " + lieu.ville + "</p>" +

                            "<button class=\"btn moreInfoButton mx-auto\" id=\"" + lieu.id + "\" style=\"color:white; background-color: #94D1BE\">plus d'infos</button>" +
                            "<a target=\"_self\" onclick=\"event.preventDefault(); " + 
                            // document.getElementById(lieu.id).addEventListener('click', (button) => component.$router.push('/inscription'));
                             + "\">plus d'infos</a>"

                        var popupOptions =
                        {
                            'maxWidth': '30vw',
                            'className': 'popupLieu'
                        }

                        L.marker([lieu.latitude, lieu.longitude]).addTo(this.map)
                            .bindPopup(popupContent, popupOptions)

                        // marker._icon.classList.add("huechange"); //  + img.huechange { filter: hue-rotate(120deg); } => ne marchent pas
                    })
                })
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
                    this.initializeMap()
                    // si accès refusé, on stocke cela dans le state et on l'affiche dans la console
                }, () => {
                    store.commit('storeGeolocationAnswered', true)
                    console.log("accès à la position refusé, choix stocké dans le state")
                    this.initializeMap()
                }
                )
            } else {
                alert("La géolocalisation est indisponible sur votre navigateur")
                this.initializeMap()
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