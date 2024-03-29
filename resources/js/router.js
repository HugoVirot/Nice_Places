import { createWebHistory, createRouter } from "vue-router";
import App from "./components/App";
import Carte from "./components/views/Carte"
import Categories from "./components/views/Categories"
import DetailCategorie from "./components/views/DetailCategorie"
import TopLieux from "./components/views/TopLieux"
import Lieu from "./components/views/Lieu"
import ProposerLieu from "./components/views/ProposerLieu"
import Inscription from "./components/user/Inscription"
import Connexion from "./components/user/Connexion"
import MonCompte from "./components/user/MonCompte"
import SuccessMessage from "./components/utilities/SuccessMessage"
import MesLieuxPostes from "./components/user/MesLieuxPostes"
import MesLieuxFavoris from "./components/user/MesLieuxFavoris"
import BackOffice from "./components/backoffice/BackOffice"
import ModifierLieu from "./components/backoffice/ModifierLieu"
import ModifierCategorie from "./components/backoffice/ModifierCategorie"
import ModifierAvis from "./components/backoffice/ModifierAvis"
import ModifierImage from "./components/backoffice/ModifierImage"
import MesNotifications from "./components/user/MesNotifications"
import UploadImages from "./components/views/UploadImages"
import Contact from "./components/views/Contact"
import Politique from "./components/views/Politique"

const routes = [
  {
    path: "/",
    name: "App",
    component: App,
  },
  {
    path: "/carte",
    component: Carte,
  },
  {
    path: "/categories",
    component: Categories,
  },
  {
    path: "/categories/:id",
    component: DetailCategorie,
  },
  {
    path: "/toplieux",
    name: "toplieux",
    component: TopLieux,
  },
  {
    path: "/lieu/:id",
    component: Lieu,
  },
  {
    path: "/proposerlieu",
    component: ProposerLieu,
  },
  {
    path: "/inscription",
    component: Inscription,
  },
  {
    path: "/connexion",
    component: Connexion,
  },
  {
    path: "/moncompte",
    component: MonCompte,
  },
  {
    path: "/meslieuxpostes",
    name: 'meslieuxpostes',
    component: MesLieuxPostes,
  },
  {
    path: "/meslieuxfavoris",
    component: MesLieuxFavoris,
  },
  {
    path: "/backoffice",
    component: BackOffice,
  },
  {
    path: "/successmessage/:nextpage/:message/:lieuid?",
    component: SuccessMessage,
  },
  {
    path: "/modifierlieu/:id",
    component: ModifierLieu,
  },
  {
    path: "/modifiercategorie/:id",
    component: ModifierCategorie,
  },
  {
    path: "/modifieravis/:id",
    component: ModifierAvis,
  },
  {
    path: "/modifierimage/:id",
    component: ModifierImage,
  },
  {
    path: "/mesnotifications",
    component: MesNotifications,
  },
  {
    path: "/uploadimages/:id",
    component: UploadImages,
  },
  {
    path: "/contact",
    component: Contact
  },
  {
    path: "/politique",
    component: Politique
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;