<script>
import { store } from '../store'

export default {

    computed: {
        userData() {
            return store.state.userData
        }
    },

    methods: {
        logOut() {
            // on réinitialise le state en appelant l'action "logOut"
            store.dispatch("logOut");

            // // on teste le résultat
            console.log(store.state.userData)

            // //idem pour le message de succès
            store.commit('storeMessage', "Déconnexion réussie")
            console.log(store.state.message)

            // on redirige vers l'accueil
            this.$router.push('/SuccessMessage')
            // rediriger vers SuccessMessage
        }
    }
}
</script>

<template>

    <header class="sticky-top">

        <div class="container-fluid pt-1 d-flex align-items-center navbar-dark">

            <!-- ************************** titre et bandes ***********************-->

            <div class="mt-1 d-none d-md-block" id="leftstripe"></div>

            <!-- image avec deux bandes (mobiles uniquement) -->
            <img class="d-block mt-3 d-md-none" id="twostripes" alt="twostripes"
                src="images/bandes-gauche-header.png" />

            <div class="d-flex flex-column mx-auto text-center">
                <router-link to="/">
                    <img id="logo" alt="logo" src="images/logo.png" />
                </router-link>
                <p id="textelogo" class="mx-auto d-none d-md-block">
                    <span class="greentext">sorties nature </span>
                    <span class="bluetext">près de chez vous</span>
                </p>
            </div>

            <div class="mt-3 d-none d-md-block" id="rightstripe"></div>

            <!-- hamburger -->

            <button class="navbar-toggler mt-3 d-md-none my-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- ************************** navbar ***********************-->

        <nav class="navbar navbar-expand-md navbar-light">

            <div class="container-fluid">

                <!-- liens -->

                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    <div class="navbar-nav container d-md-flex justify-content-around text-center">

                        <router-link to="/" class="navbar-brand">accueil</router-link>
                        <router-link to="/carte" class="nav-link active" aria-current="page">carte</router-link>
                        <router-link to="/toplieux" class="nav-link">top des lieux</router-link>
                        <router-link to="/proposerlieu" class="nav-link">proposer un lieu</router-link>

                        <!-- si utilisateur connecté : mon compte / mes lieux, si pas connecté : inscription/connexion -->
                        <span v-if="userData.pseudo" class="d-flex justify-content-between">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ userData.pseudo }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li>
                                        <router-link to="/moncompte" class="nav-link">mon compte</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/meslieuxpostes" class="nav-link">mes lieux postés
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/meslieuxfavoris" class="nav-link">mes lieux favoris
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/mesavispostes" class="nav-link">mes avis postés
                                        </router-link>
                                    </li>
                                    <li v-if="userData.role == 'admin'">
                                        <router-link to="/backoffice" class="nav-link">back-office
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <i id="logoutIcon" class="fa-solid fa-right-from-bracket my-auto" @click="logOut()"></i>
                        </span>

                        <span v-else class="d-md-flex justify-content-center">
                            <router-link to="/inscription" class="nav-link me-md-3 me-lg-5">inscription</router-link>
                            <router-link to="/connexion" class="nav-link">connexion</router-link>
                        </span>

                    </div>
                </div>

            </div>

        </nav>

    </header>

</template>

<style>
@font-face {
    font-family: 'Cooper';
    src: './Cooper Black Regular.ttf';
}

header {
    background-color: white;
    box-shadow: 5px 3px 3px #94D1BE;
}

#twostripes {
    width: 15vw
}

#logo {
    width: 260px
}

#textelogo {
    font-size: 16px;
}

a {
    text-decoration: none;
    color: inherit
}

#logoutIcon {
    color: #94D1BE
}

.dropdown-menu .router-link {
    color: #94D1BE
}

body {
    font-family: 'Cooper';
}

#leftstripe {
    width: 33vw;
    background-color: #94D1BE;
    height: 2vh;
}

#rightstripe {
    width: 33vw;
    background-color: #1C6E8C;
    height: 2vh;
}

.greentext {
    color: #94D1BE
}


.bluetext {
    color: #1C6E8C
}

.navbar-brand,
.nav-link {
    color: #1C6E8C !important
}

.navbar-toggler {
    background-color: #94D1BE;
    border-radius: 30%;
}

@media screen and (max-width: 480px) {
    #logo {
        width: 180px
    }
}
</style>
