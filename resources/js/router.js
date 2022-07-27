import { createWebHistory, createRouter } from "vue-router";
import App from "./components/App";
import Carte from "./components/Carte"
import TopLieux from "./components/TopLieux"
import Lieu from "./components/Lieu"
import ProposerLieu from "./components/ProposerLieu"
import Inscription from "./components/Inscription"
import Connexion from "./components/Connexion"
import MonCompte from "./components/MonCompte"
import SuccessMessage from "./components/SuccessMessage"
import MesLieuxPostes from "./components/MesLieuxPostes"
import MesLieuxFavoris from "./components/MesLieuxFavoris"
import MesAvisPostes from "./components/MesAvisPostes"
import BackOffice from "./components/BackOffice"
import ModifierLieu from "./components/ModifierLieu"
import ModifierCategorie from "./components/ModifierCategorie"
import ModifierAvis from "./components/ModifierAvis"
import ModifierImage from "./components/ModifierImage"
import UploadImages from "./components/UploadImages"
import DerniersLieux from "./components/DerniersLieux"

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
    path: "/dernierslieux",
    component: DerniersLieux,
  },
  {
    path: "/toplieux",
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
    component: MesLieuxPostes,
  },
  {
    path: "/meslieuxfavoris",
    component: MesLieuxFavoris,
  },
  {
    path: "/mesavispostes",
    component: MesAvisPostes,
  },
  {
    path: "/backoffice",
    component: BackOffice,
  },
  {
    path: "/successmessage",
    component: SuccessMessage,
  },
  {
    path: "/modifierlieu/:id",
    component: ModifierLieu
  },
  {
    path: "/modifiercategorie/:id",
    component: ModifierCategorie
  },
  {
    path: "/modifieravis/:id",
    component: ModifierAvis
  },
  {
    path: "/modifierimage/:id",
    component: ModifierImage
  },
  {
    path: "/uploadimages",
    component: UploadImages
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;