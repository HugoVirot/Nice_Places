<script>
import Header from "./Header.vue"
import Slider from "./Slider.vue"
import Map from "./Map.vue"
import Footer from "./Footer.vue"

export default {
	data() {
		return {
			message: "Bienvenue sur Vue 3"
		};
	},
	components: { Header, Slider, Map, Footer }
}
</script>

<style scoped>
img {
	height: 1.7em
}

.titleIcon {
	height: 8vh
}

h2 {
	color: #1c6e8c
}

#presentation {
	background-position: center;
	background-size: cover;
	height: 55vh
}

#presentationTopStripe {
	width: 100vw;
	background-color: #94D1BE;
	height: 2vh;
}

#presentationBottomStripe {
	width: 100vw;
	background-color: #1C6E8C;
	height: 2vh;
}

#toplieux,
#dernierslieux {
	height: 50vh;
	color: white
}

#toplieux button,
#dernierslieux button {
	background-color: #1c6e8c !important;
}

.infoslieu {
	background-color: rgba(50, 61, 158, 0.5);
}

.ranking {
	font-size: 2em;
}

.categoryicon {
	background-color: white;
}

#inscrivezVous {
	color: #1c6e8c;
}

.inscrivezVousIcones {
	width: 15vw;
	height: 15vw
}

#pointer {
	width: 10vw;
	height: 15vw
}

@media screen and (max-width: 580px) {

	#toplieux,
	#dernierslieux {
		height: 120vh;
	}

	#presentation {
		height: 62vh
	}

	.inscrivezVousIcones {
		width: 30vw;
		height: 30vw
	}

	#pointer {
		width: 20vw;
		height: 30vw
	}

}

@media screen and (min-width: 581px) and (max-width: 768px) {

	#toplieux,
	#dernierslieux {
		height: 70vh;
	}

	#presentation {
		height: 57vh
	}
}

@media screen and (min-width: 769px) and (max-width: 992px) {

	#toplieux,
	#dernierslieux {
		height: 60vh;
	}
}

@media screen and (min-width: 581px) and (max-width: 992px) {
	.inscrivezVousIcones {
		width: 17vw;
		height: 17vw
	}

	#pointer {
		width: 11vw;
		height: 17vw
	}
}
</style>

<template>
	<div class="text-center p-1">
		<Header />

		<div v-if="$route.path !== '/'">
			<!-- si la route est différente de / (racine du site) -->
			<!-- on affiche le template du composant concerné par la route -->
			<router-view v-bind:key="$route.fullPath"></router-view>
		</div>

		<div v-else>
			<!-- si la route est / => on affiche le code de l'accueil-->

			<Slider />

			<div id="presentationTopStripe" class="mt-5"></div>

			<div class="container-fluid p-5" id="presentation" style="background-image: url(images/mervent2.jpg)">
				<div class="row pb-4">
					<div class="col-md-6 my-auto">
						<img class="w-100 h-100" src="images/logo.png">
					</div>

					<div class="col-md-6 my-auto">
						<p class="text-white fs-3">Un site et un appli mobile simples à utiliser, pour trouver et
							partager
							des
							sorties nature
							(plage,
							forêt, lac, montagne...) près de chez vous !</p>
					</div>
				</div>

				<a href="/"><button class="btn btn-lg mt-3 rounded-pill">Je m'inscris</button></a>
			</div>

			<div id="presentationBottomStripe" class="mb-3"></div>

			<img class="titleIcon mt-5 mx-auto" src="images/icons/pointer.png" alt="pointeur">
			<h2 class="fs-2 m-3"> Carte des lieux autour de chez vous</h2>

			<Map />

			<div>
				<img class="titleIcon mt-5 mx-auto" src="images/icons/star.png" alt="étoile">
				<h2 class="fs-2 m-3">Le top des lieux dans votre région</h2>
			</div>

			<div class="container-fluid">

				<div class="row m-1 p-1" id="toplieux">

					<!-- ********************** lieu 1 ************************* -->

					<div class="mx-auto col-sm-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
						style="background-image: url(images/oiseaux.jpg); background-position: center; background-size: cover;">

						<div class="infoslieu p-1">

							<div class="row d-flex justify-content-between align-items-center">
								<div class="col-2">
									<span class="ranking"> #1 </span>
								</div>
								<div class="col-10">
									<h4>Parc Ornithologique</h4>
								</div>
							</div>

							<div class="row">
								<div class="col-3">
									<img src="images/icons/star.png" alt="pointeur"> 9.3
								</div>
								<div class="col-7">
									<h5>St-Hilaire-la-Palud (79)</h5>
								</div>
								<div class="col-2 d-flex justify-content-center align-items-center">
									<img class="bg-white rounded-pill p-1" src="images/icons/step.png" alt="patte">
								</div>
							</div>

						</div>

						<button class="btn btn-lg rounded-pill">découvrir</button>

					</div>

					<!-- ********************** lieu 2 ************************* -->

					<div class="mx-auto col-sm-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
						style="background-image: url(images/oiseaux.jpg); background-position: center; background-size: cover;">

						<div class="infoslieu p-1">

							<div class="row d-flex justify-content-between align-items-center">
								<div class="col-2">
									<span class="ranking"> #1 </span>
								</div>
								<div class="col-10">
									<h4>Parc Ornithologique</h4>
								</div>
							</div>

							<div class="row">
								<div class="col-3">
									<img src="images/icons/star.png" alt="pointeur"> 9.3
								</div>
								<div class="col-7">
									<h5>St-Hilaire-la-Palud (79)</h5>
								</div>
								<div class="col-2 d-flex justify-content-center align-items-center">
									<img class="bg-white rounded-pill p-1" src="images/icons/step.png" alt="patte">
								</div>
							</div>

						</div>

						<button class="btn btn-lg rounded-pill">découvrir</button>

					</div>

					<!-- ********************** lieu 3 ************************* -->

					<div class="mx-auto col-sm-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
						style="background-image: url(images/oiseaux.jpg); background-position: center; background-size: cover;">

						<div class="infoslieu p-1">

							<div class="row d-flex justify-content-between align-items-center">
								<div class="col-2">
									<span class="ranking"> #1 </span>
								</div>
								<div class="col-10">
									<h4>Parc Ornithologique</h4>
								</div>
							</div>

							<div class="row">
								<div class="col-3">
									<img src="images/icons/star.png" alt="pointeur"> 9.3
								</div>
								<div class="col-7">
									<h5>St-Hilaire-la-Palud (79)</h5>
								</div>
								<div class="col-2 d-flex justify-content-center align-items-center">
									<img class="bg-white rounded-pill p-1" src="images/icons/step.png" alt="patte">
								</div>
							</div>

						</div>

						<button class="btn btn-lg rounded-pill">découvrir</button>

					</div>

				</div>

				<a href="/"><button class="btn btn-lg mt-3 rounded-pill">Classement complet</button></a>

			</div>


			<!-- ********************************* derniers lieux ajoutés *************************************** -->

			<img class="titleIcon mt-5 mx-auto" src="images/icons/clock.png" alt="pointeur">
			<h2 class="fs-2 m-3"> Derniers lieux ajoutés</h2>

			<div class="container-fluid">

				<div class="row m-1 p-1" id="dernierslieux">

					<!-- ********************** lieu 1 ************************* -->

					<div class="mx-auto col-sm-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
						style="background-image: url(images/planete_sauvage.jpg); background-position: center; background-size: cover;">

						<div class="infoslieu p-1">

							<div class="row d-flex justify-content-between">
								<div class="col-8">
									<h4 class="fs-3">Planète Sauvage</h4>
								</div>
								<div class="col-4 d-flex justify-content-center align-items-center">
									<img class="bg-white rounded-pill p-1" src="images/icons/step.png" alt="patte">
								</div>
							</div>

							<div class="row">
								<div class="row col-xxl-6">

									<div class="col-3">
										<img src="images/icons/pointer.png" alt="pointeur">
									</div>

									<div class="col-9">
										<p>Port-St-Père (44)</p>
									</div>

								</div>

								<div class="row col-xxl-6">

									<div class="col-3">
										<img src="images/icons/user.png" alt="user">
									</div>

									<div class="col-9">
										<h5>par Sam Martin</h5>
									</div>
								</div>

							</div>

						</div>

						<button class="btn btn-lg rounded-pill">découvrir</button>

					</div>

					<!-- ********************** lieu 2 ************************* -->

					<div class="mx-auto col-sm-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
						style="background-image: url(images/planete_sauvage.jpg); background-position: center; background-size: cover;">

						<div class="infoslieu p-1">

							<div class="row d-flex justify-content-between">
								<div class="col-8">
									<h4 class="fs-3">Planète Sauvage</h4>
								</div>
								<div class="col-4 d-flex justify-content-center align-items-center">
									<img class="bg-white rounded-pill p-1" src="images/icons/step.png" alt="patte">
								</div>
							</div>

							<div class="row">
								<div class="row col-xxl-6">

									<div class="col-3">
										<img src="images/icons/pointer.png" alt="pointeur">
									</div>

									<div class="col-9">
										<p>Port-St-Père (44)</p>
									</div>

								</div>

								<div class="row col-xxl-6">

									<div class="col-3">
										<img src="images/icons/user.png" alt="user">
									</div>

									<div class="col-9">
										<h5>par Sam Martin</h5>
									</div>
								</div>

							</div>

						</div>

						<button class="btn btn-lg rounded-pill">découvrir</button>

					</div>

					<!-- ********************** lieu 3 ************************* -->

					<div class="mx-auto col-sm-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
						style="background-image: url(images/planete_sauvage.jpg); background-position: center; background-size: cover;">

						<div class="infoslieu p-1">

							<div class="row d-flex justify-content-between">
								<div class="col-8">
									<h4 class="fs-3">Planète Sauvage</h4>
								</div>
								<div class="col-4 d-flex justify-content-center align-items-center">
									<img class="bg-white rounded-pill p-1" src="images/icons/step.png" alt="patte">
								</div>
							</div>
							<div class="row">
								<div class="row col-xxl-6">

									<div class="col-3">
										<img src="images/icons/pointer.png" alt="pointeur">
									</div>

									<div class="col-9">
										<p>Port-St-Père (44)</p>
									</div>

								</div>

								<div class="row col-xxl-6">

									<div class="col-3">
										<img src="images/icons/user.png" alt="user">
									</div>

									<div class="col-9">
										<h5>par Sam Martin</h5>
									</div>
								</div>

							</div>

						</div>

						<button class="btn btn-lg rounded-pill">découvrir</button>

					</div>

				</div>
			</div>

			<a href="/"><button class="btn btn-lg mt-3 rounded-pill">Proposer un lieu</button></a>

			<!-- ******************* inscrivez-vous ****************************** -->

			<section id="inscrivezVous">

				<img class="titleIcon mt-5 mx-auto" src="images/icons/user.png" alt="user">
				<h2 class="fs-2 m-3">Inscrivez-vous gratuitement !</h2>

				<div class="container-fluid px-5">
					<div class="row" id="inscrivezVousIcones">
						<div class="col-md-4 p-1">
							<img class="inscrivezVousIcones" src="images/icons/france.png" alt="France">
							<p class="fs-4 mt-3">Des lieux dans toute la France</p>
						</div>

						<div class="col-md-4 p-1">
							<img id="pointer" src="images/icons/pointer.png" alt="pointeur">
							<p class="fs-4 mt-3">Partagez vos coins préférés</p>
						</div>

						<div class="col-md-4 p-1">
							<img class="inscrivezVousIcones" src="images/icons/phone.png" alt="téléphone">
							<p class="fs-4 mt-3">Un site web et une appli mobile</p>
						</div>
					</div>
				</div>

				<a href="/"><button class="btn btn-lg mt-3 rounded-pill">Je m'inscris</button></a>

			</section>

		</div>
	</div>

	<Footer />

</template>