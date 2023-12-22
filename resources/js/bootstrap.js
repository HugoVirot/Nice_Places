window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { useUserStore } from './stores/userStore'

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

// implémentation de Sanctum => 2ème méthode : SPA Authentication
// grâce à cette ligne de code, axios envoie automatiquement le cookie de session Laravel à chaque requête
// but => authentifier les requêtes
// cette ligne permet également d'éviter le problème de CORS
window.axios.defaults.withCredentials = true;

// afficher chaque requête en console
// window.axios.interceptors.request.use(request => {
//   console.log('Starting Request', JSON.stringify(request, null, 2))
//   return request
// })

// intercepter les erreurs 401 et déconnecter l'utilisateur si c'est le cas
window.axios.interceptors.response.use(function (response) {
  return response;
}, function (error) {
  if (401 === error.response.status) {

    alert('Votre session a expiré. Vous allez être déconnecté(e). Merci de vous reconnecter.')

    // alert ok, déconnexion ok mais pas de redirection redirection
    const userStore = useUserStore() 
    userStore.$reset()

    // on redirige vers l'accueil
    this.$router.push('/successmessagehome/Déconnexion réussie')

      // swal({
      //     title: "Session Expired",
      //     text: "Votre session a expiré. Voulez-vous être redirigé sur la page de connection ?",
      //     type: "warning",
      //     showCancelButton: true,
      //     confirmButtonColor: "#DD6B55",
      //     confirmButtonText: "Yes",
      //     closeOnConfirm: false
      // }, function(){
      //     window.location = '/connexion';
      // });
  } else {
      return Promise.reject(error);
  }
});