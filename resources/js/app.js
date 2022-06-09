require('./bootstrap');

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

// 1. On importe createApp
import { createApp } from "vue"

import { store } from "./store";

// On importe le composant principal App
import App from "./components/App.vue"

// On importe le routeur
import router from './router'

// On monte l'application Vue sur l'élément #app
// on inclut le routeur et le store dans l'application
createApp(App).use(router, store).mount("#app")
