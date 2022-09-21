require('./bootstrap');

// on importe Bootstrap
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

// On importe createApp
import { createApp } from "vue"

// On importe le composant principal App
import App from "./components/App.vue"

// On importe le routeur
import router from './router'

// on importe le store
import { store } from "./store";

// On monte l'application Vue sur l'élément #app
// on inclut le routeur et le store dans l'application
createApp(App).use(router).use(store).mount("#app")
