window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// import { useUserStore } from './stores/userStore'

// const userStore = useUserStore;
// console.log(userStore.pseudo)

// if (userStore.token != '') {
//   // pour transmettre le token (créé par l'API) avec chaque requête si connecté
//   console.log("user connecté, token transmis")
//   console.log(userStore.token)
//   axios.defaults.headers.common.Authorization = `Bearer ${userStore.token}`
// }

// indique que le contenu est encodé via brotli => accélération de l'affichage du site (réduction taille app.js)
// window.axios.defaults.headers.common['Content-Encoding'] = 'br';  

// autoriser la mise en cache des images par le navigateur pendant une semaine
// window.axios.defaults.headers.common['Cache-Control'] = 'public, max-age=31536000, must-revalidate';

// implémentation de Sanctum => cette ligne permet d'éviter le problème de CORS
// axios envoie le cookie XSRF d'authentification à chaque requête
window.axios.defaults.withCredentials = true;

// afficher chaque requête en console
window.axios.interceptors.request.use(request => {
  console.log('Starting Request', JSON.stringify(request, null, 2))
  return request
})
