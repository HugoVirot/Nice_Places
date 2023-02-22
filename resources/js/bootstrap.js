window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// accepter les encodages gzip et brotli pour app.js => accélération de l'affichage du site
// window.axios.defaults.headers.common['Accept-Encoding'] = 'gzip, compress, br';  // alerte de sécurité : header dangereux refusé, etc => à corriger

// autoriser la mise en cache des images par le navigateur pendant une semaine
window.axios.defaults.headers['Cache-Control'] = 'public, max-age=31536000, must-revalidate';

// implémentation de Sanctum => cette ligne permet d'éviter le problème de CORS
// axios envoie le cookie XSRF d'authentification à chaque requête
window.axios.defaults.withCredentials = true;

// afficher chaque requête en console
window.axios.interceptors.request.use(request => {
    console.log('Starting Request', JSON.stringify(request, null, 2))
    return request
  })
