require('./bootstrap');


// 1. On importe createApp
import { createApp } from "vue"

// 2. On importe AppComponent.vue
import App from "./components/App.vue"

// 3. On importe le routeur
import router from './router'

// 4. On monte l'application Vue sur l'élément #app
createApp(App).use(router).mount("#app")