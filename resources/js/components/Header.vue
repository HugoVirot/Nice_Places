<script>
export default {
}
</script>

<style>
@font-face {
    font-family: 'Cooper';
    src: './Cooper Black Regular.ttf';
}

header {
    background-color: white;
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

@media screen and (max-width: 480px) {
    #logo {
        width: 180px
    }
}
</style>

<template>

    <header class="sticky-top">

        <div class="container-fluid pt-3 d-flex align-items-center navbar-dark">

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
                    <span id="greentext">sorties nature </span>
                    <span id="bluetext">près de chez vous</span>
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
                        <router-link to="/" class="nav-link active" aria-current="page">carte</router-link>
                        <router-link to="/" class="nav-link">top des lieux</router-link>
                        <router-link to="/" class="nav-link">proposer un lieu</router-link>
                        <!-- ajouter condition : si pas connecté : inscription/connexion, si connecté : mon compte -->
                        <router-link to="/" class="nav-link">inscription</router-link>
                        <router-link to="/" class="nav-link">connexion</router-link>
                        <router-link to="/" class="nav-link">mon compte</router-link>
                    </div>
                </div>

            </div>

        </nav>

    </header>

</template>