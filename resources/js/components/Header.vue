<script>
export default {
    data() {
        return {
            message: "Bienvenue sur Vue 3"
        }
    }
}
</script>

<style>
@font-face {
    font-family: 'Cooper';
    src: './Cooper Black Regular.ttf';
}

a {
    text-decoration: none;
    color: inherit
}

body {
    font-family: 'Cooper';
}

#leftstripe {
    width: 27vw;
    background-color: #94D1BE;
    height: 5vh;
}

#logo {
    width: 46vw
}

#rightstripe {
    width: 27vw;
    background-color: #1C6E8C;
    height: 5vh;
}

#greentext {
    color: #94D1BE
}


#bluetext {
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

/* ne marche pas */
/* .nav-link:nth-child(odd) {
    color: #1C6E8C
}

.nav-link:nth-child(even) {
    color: #94D1BE
} */
</style>

<template>
    <header class="sticky-top">

        <div class="container-fluid pt-3 d-flex align-items-center navbar-dark">

            <!-- ************************** titre et bandes ***********************-->
            <div class="mt-3 d-none d-md-block" id="leftstripe"></div>

            <div class="d-flex flex-column mx-auto text-center">
                <router-link to="/">
                    <img id="logo" alt="logo" src="images/logo.png" />
                </router-link>
                <p class="mx-auto d-none d-md-block fs-4">
                    <span id="greentext">sorties nature </span>
                    <span id="bluetext">près de chez vous</span>
                </p>
            </div>

            <div class="mt-3 d-none d-md-block" id="rightstripe"></div>

            <!-- hamburger -->

            <button class="navbar-toggler d-md-none my-auto" type="button" data-bs-toggle="collapse"
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
                        <router-link to="/FrenchMovies" class="nav-link active" aria-current="page">carte</router-link>
                        <router-link to="/FrenchMovies" class="nav-link">top des lieux</router-link>
                        <router-link to="/FrenchMovies" class="nav-link">proposer un lieu</router-link>
                        <!-- ajouter condition : si pas connecté : inscription/connexion, si connecté : mon compte -->
                        <router-link to="/FrenchMovies" class="nav-link">mon compte</router-link>
                    </div>
                </div>

            </div>

        </nav>

    </header>

    <div style="height: 200vh">Test</div>
</template>