window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// implémentation de Sanctum => cette ligne permet d'éviter le problème de CORS
window.axios.defaults.withCredentials = true;

// gérer les erreurs des appels api

import { useUserStore } from "./stores/userStore"

axios.interceptors.response.use(function (response) { return response },
    function (error) {
        console.log("fonction error de l'interceptor");
        console.log(error.response);
        const userStore = useUserStore()

        if (error.response.data.errors) {
            userStore.storeErrors(error.response.data.errors)
            // return Promise.reject(error.response);
            //throw error;
        }
        else if (error.response.message) {
            alert(error.response.message)
        }
        else {
            alert("Une erreur s'est produite. Certains éléments peuvent ne pas être affichés. Vous pouvez essayer de recharger la page pour corriger le problème.")
        }
    });