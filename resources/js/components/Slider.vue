<script>
export default {
}
</script>

<style>
.captionfondbleu {
    background-color: rgba(50, 61, 158, 0.5);
}

p {
    font-size: larger;
}

h2 {
    font-size: 3.1vw;
    z-index: 1;
}

.btn {
    background-color: #94D1BE !important;
    color: white;
}
</style>

<template>
    <div id="carouselAccueil" class="carousel slide carousel-fade container" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/barque.jpg" class="d-block w-100" alt="marais poitevin">
                <div class="carousel-caption captionfondbleu d-none d-md-block p-5">
                    <h2>Redécouvrez votre région !</h2>
                    <p>Vous serez étonné(e) par les nombreux lieux extraordinaires qu'elle propose.</p>
                    <a href=""><button class="btn btn-lg">Voir la carte des lieux</button></a>
                </div>
                <h2 class="carousel-caption d-block d-md-none fs-1">Redécouvrez votre région !</h2>
            </div>
            <div class="carousel-item">
                <img src="images/plage_la_faute.jpg" class="d-block w-100" alt="plage de la Faute">
                <div class="carousel-caption captionfondbleu d-none d-md-block p-5">
                    <h2>Partagez vos coups de coeur !</h2>
                    <p>Faites profiter la communauté de vos petits coins de paradis.</p>
                    <a href=""><button class="btn btn-lg">Voir la carte des lieux</button></a>
                </div>
                <h2 class="carousel-caption d-block d-md-none fs-1">Partagez vos coups de coeur !</h2>
            </div>
            <div class="carousel-item">
                <img src="images/mervent.jpg" class="d-block w-100" alt="forêt de Mervent">
                <div class="carousel-caption captionfondbleu d-none d-md-block p-5">
                    <h2>Destination nature !</h2>
                    <p>Plages, forêts, rivières ou encore zoos : il y a toujours une nouvelle sortie sur Nice Places !
                    </p>
                    <a href=""><button class="btn btn-lg">Voir la carte des lieux</button></a>
                </div>
                <h2 class="carousel-caption d-block d-md-none fs-1 ">Destination nature !</h2>
            </div>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselAccueil" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselAccueil" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselAccueil" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAccueil" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselAccueil" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>