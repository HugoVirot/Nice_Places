import { createWebHistory, createRouter } from "vue-router";
import App from "./components/App.vue";
import Carte from "./components/Carte.vue"
import TopLieux from "./components/TopLieux.vue"
import Lieu from "./components/Lieu.vue"
import ProposerLieu from "./components/ProposerLieu.vue"
import Inscription from "./components/Inscription.vue"
import Connexion from "./components/Connexion.vue"
import MonCompte from "./components/MonCompte.vue"
import SuccessMessage from "./components/SuccessMessage.vue"
import MesLieuxPostes from "./components/MesLieuxPostes.vue"
import MesLieuxFavoris from "./components/MesLieuxFavoris.vue"

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
    path: "/lieu/:id",
    name: "Lieu",
    component: Lieu,
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
  },
  {
    path: "/meslieuxpostes",
    name: "MesLieuxPostes",
    component: MesLieuxPostes,
  },
  {
    path: "/meslieuxfavoris",
    name: "MesLieuxFavoris",
    component: MesLieuxFavoris,
  },
  {
    path: "/successmessage",
    name: "SuccessMessage",
    component: SuccessMessage,
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;