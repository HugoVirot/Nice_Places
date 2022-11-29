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

import { useUserStore } from './stores/userStore'
const userStore = useUserStore

// afficher chaque requête en console
window.axios.interceptors.request.use(request => {
    console.log('Starting Request', JSON.stringify(request, null, 2))
    return request
  })
