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

// tests avec axios et window.axios (2 échecs)

//******************** TEST 1 : pas d'erreurs, les appels fonctionnent, mais pas de token transmis *********************

// if (userStore.state){
//     const token = userStore.state.token

//       if (token != "") {
//         window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
//     }

// }
  
// afficher chaque requête en console
window.axios.interceptors.request.use(request => {
    console.log('Starting Request', JSON.stringify(request, null, 2))
    return request
  })

  //******************** TEST 2 : les appels ne fonctionnent plus *********************

// window.axios.interceptors.request.use(config => {

//     const token = userStore.state.token;
    
//     if (token != "") {
//         config.headers.Authorization = `Bearer ${token}` // config.headers["Authorization"] = `Bearer ${token}` ne marche pas non plus
//     }

//     config.headers.Accept = "application/json"
//     // config.headers.Content-Type = "application/json"

//     return config
// })
