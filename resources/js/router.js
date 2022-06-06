import { createWebHistory, createRouter } from "vue-router";
import App from "./components/App.vue";
import Carte from "./components/Carte.vue"
import TopLieux from "./components/TopLieux.vue"
import ProposerLieu from "./components/ProposerLieu.vue"
import Inscription from "./components/Inscription.vue"
import Connexion from "./components/Connexion.vue"
import MonCompte from "./components/MonCompte.vue"

const routes = [
  {
    path: "/",
    name: "App",
    component: App,
  },
  {
    path: "/carte",
    name: "Carte",
    component: Carte,
  },
  {
    path: "/toplieux",
    name: "TopLieux",
    component: TopLieux,
  },
  {
    path: "/proposerlieu",
    name: "ProposerLieu",
    component: ProposerLieu,
  },
  {
    path: "/inscription",
    name: "Inscription",
    component: Inscription,
  },
  {
    path: "/connexion",
    name: "Connexion",
    component: Connexion,
  },
  {
    path: "/moncompte",
    name: "MonCompte",
    component: MonCompte,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;