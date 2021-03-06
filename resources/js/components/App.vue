<script>
import Header from "./Header.vue"
import Slider from "./Slider.vue"
import Map from "./Map.vue"
import Footer from "./Footer.vue"
import { store } from '../store'
import axios from "axios"

export default {

	// computed permet de surveiller automatiquement les changements
	// de userData dans le state => utile pour la déconnexion
	computed: {
		userData() {
			return store.state.userData
		},
		threeTopPlaces() {
			return store.state.threeTopPlaces
		},
		threeLastPlaces() {
			return store.state.threeLastPlaces
		},
		categories() {
			return store.state.categories
		},
		lieux() {
			return store.state.lieux
		}
	},

	watch: {
		userData: {
			handler() {
				this.getThreeTopAndLastPlaces()
			}, deep: true
		},
	},

	methods: {

		// on récupère les catégories et on les stocke dans le store

		getCategories() {
			axios.get("http://localhost:8000/api/categories")
				.then(response => {
					store.commit('storeCategories', response.data)
					console.log(this.categories)
				}
				)
				.catch(error => {
					console.log(error.response)
				})
		},

		getLieux() {
			axios.get("http://localhost:8000/api/lieus")
				.then(response => {
					store.commit('storeLieux', response.data)
					console.log(this.lieux)
				}
				)
				.catch(error => {
					console.log(error.response)
				})
		},

		// on récupère les 3 endroits les mieux notés + les 3 derniers

		getThreeTopAndLastPlaces() {
			let department

			// si l'utilisateur a choisi un département
			if (store.state.userData.departement) {
				department = store.state.userData.departement
				//sinon => on cible la France entière
			} else {
				department = "all"
			}

			// on récupère les 3 lieux les mieux notés du dép. / de la France entière
			// on les stocke dans le store

			axios.post("http://localhost:8000/api/lieus/gettopplacesbydep", null, {
				params: {
					department: department
				}
			})
				.then(response => {
					store.commit('storeThreeTopPlaces', response.data)
					console.log(this.threeTopPlaces)
				}
				)
				.catch(error => {
					console.log(error.response)
				})

			// on récupère les 3 derniers lieux ajoutés du dép. / de la France entière
			// on les stocke dans le store

			axios.post("http://localhost:8000/api/lieus/getlastplacesbydep", null, {
				params: {
					department: department
				}
			})
				.then(response => {
					store.commit('storeThreeLastPlaces', response.data)
					console.log(this.threeLastPlaces)
				}
				)
				.catch(error => {
					console.log(error.response)
				})
		}
	},

	created() {

		// on récupère les catégories et on les stocke dans le store
		if (!this.categories) {
			this.getCategories()
		}

		if (!this.lieux) {
			this.getLieux()
		}

		console.log(store.state.userPosition)

		// ******************* si réponse à la demande de géoloc ************************
		if (store.state.geolocationAnswered) {

			//*********** si géoloc acceptée => userPosition disponible (pas vide)*********
			if (store.state.userPosition) {

				// on détecte le département de l'utilisateur

				// on récupère les 3 derniers lieux ajoutés + les 3 les mieux notés du dép.

				// on les stocke dans des variables locales ou du store

			} else {
				// *************** si le user a refusé la géoloc  *****

				this.getThreeTopAndLastPlaces()

			}
		}
	},

	components: { Header, Slider, Map, Footer }
}
</script>

<template>
	<div class="text-center">

		<!-- ******************************************* HEADER *********************************************** -->

		<Header />

		<div v-if="$route.path !== '/'">
			<!-- si la route est différente de / (racine du site) -->
			<!-- on affiche le template du composant concerné par la route -->
			<router-view v-bind:key="$route.fullPath"></router-view>
		</div>

		<div v-else>
			<!-- si la route est / => on affiche le code de l'accueil-->

			<!-- ******************************************* SLIDER *********************************************** -->

			<Slider />

			<div id="presentationTopStripe" class="mt-5"></div>

			<div class="container-fluid p-5" id="presentation" style="background-image: url(images/mervent2.jpg)">
				<div class="row pb-4">
					<div class="col-md-6 my-auto">
						<img class="w-100 h-100 bg-white rounded" src="images/logo.png">
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

				<router-link to="/inscription"><button class="btn btn-lg mt-3 rounded-pill">Je m'inscris</button>
				</router-link>
			</div>

			<div id="presentationBottomStripe" class="mb-3"></div>

			<i class="titleIcon mt-5 mx-auto fa-3x fa-solid fa-location-dot"></i>
			<h2 class="fs-2 m-3"> Carte des lieux autour de chez vous</h2>


			<!-- *********************************************** CARTE ************************************************** -->

			<Map />


			<!-- ******************************************* TOP DES LIEUX *********************************************** -->

			<div v-if="threeTopPlaces && threeTopPlaces.length > 2">
				<div>
					<i class="titleIcon mt-5 mx-auto fa-3x fa-solid fa-star"></i>
					<h2 v-if="userData.departement" class="fs-2 m-3">Le top des lieux dans votre département</h2>
					<h2 v-else class="fs-2 m-3">Le top des lieux (France entière)</h2>
				</div>

				<div class="container-fluid">

					<div class="row m-1 p-1" id="toplieux">

						<!-- ********************** boucle qui affiche les 3 lieux ************************* -->

						<div v-for="(topPlace, index) in threeTopPlaces"
							class="mx-auto col-md-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
							:style="`background-image: url(images/${topPlace.images[0].nom}); background-position: center; background-size: cover;`">
							<div class="infosTopLieux pt-1 pb-3">

								<div class="rankingAndName row d-flex justify-content-between align-items-center">
									<div class="col-2">
										<span class="ranking"> #{{ index + 1 }} </span>
									</div>
									<div class="col-10">
										<h5>{{ topPlace.nom }}</h5>
									</div>
								</div>

								<div class="row">
									<div class="col-6">
										<i class="yellowStar fa-2x fa-solid fa-star me-1"></i> {{ topPlace.note }}
										<span class="fs-4 rounded-circle border border-white p-2 ms-2"
											v-html="topPlace.categorie.icone"></span>
									</div>
									<div class="col-6 d-flex">
										<i class="titleIcon fa-2x fa-solid fa-location-dot me-2"></i>
										<p class="my-auto">{{ topPlace.ville }} ({{ topPlace.code_postal.substr(0, 2) }})</p>
									</div>
								</div>

							</div>

							<router-link :to="`/lieu/${topPlace.id}`"><button
									class="btn btn-lg rounded-pill">découvrir</button></router-link>

						</div>

					</div>

					<router-link to="/toplieux"><button class="btn btn-lg mt-3 rounded-pill">Classement complet</button>
					</router-link>

				</div>
			</div>


			<!-- ********************************* DERNIERS LIEUX AJOUTES *************************************** -->

			<div v-if="threeTopPlaces && threeTopPlaces.length > 2">

				<i class="titleIcon mt-5 mx-auto fa-3x fa-solid fa-clock"></i>
				<h2 v-if="userData.departement" class="fs-2 m-3"> Derniers lieux ajoutés dans votre département</h2>
				<h2 v-else class="fs-2 m-3"> Derniers lieux ajoutés (France entière)</h2>

				<div class="container-fluid">

					<div class="row m-1 p-1" id="dernierslieux">

						<!-- ********************** boucle qui affiche les 3 derniers lieux ************************* -->

						<div v-for="lastPlace in threeLastPlaces"
							class="mx-auto col-md-6 col-lg-4 p-2 border border-white d-flex flex-column justify-content-between"
							:style="`background-image: url(images/${lastPlace.images[0].nom}); background-position: center; background-size: cover;`">

							<div class="infosDerniersLieux pt-2 px-1">

								<div class="row">
									<div class="col-2">
										<span class="fs-4 rounded-circle border border-white p-1 ms-2"
											v-html="lastPlace.categorie.icone"></span>
									</div>
									<div class="col-10">
										<h5>{{ lastPlace.nom }}</h5>
									</div>
								</div>

								<div class="row">
									<div class="row col">

										<div class="col-3">
											<i class="titleIcon fa-2x fa-solid fa-location-dot"></i>
										</div>

										<div class="col-9">
											<p>{{ lastPlace.ville }} ({{ lastPlace.code_postal.substr(0, 2) }})</p>
										</div>

									</div>

									<div class="row col-md-8" v-if="lastPlace.ville.length < 15">

										<div class="col-3">
											<i class="titleIcon fa-2x fa-solid fa-user"></i>
										</div>

										<div class="col-9">
											<p>par {{ lastPlace.user.pseudo }}</p>
										</div>
									</div>

								</div>

							</div>

							<router-link :to="`/lieu/${lastPlace.id}`"><button
									class="btn btn-lg rounded-pill">découvrir</button></router-link>

						</div>

					</div>
				</div>

				<router-link to="/proposerlieu"><button class="btn btn-lg mt-3 rounded-pill">Proposer un lieu</button>
				</router-link>

			</div>

			<!-- *********************************** INSCRIVEZ-VOUS ************************************** -->

			<section id="inscrivezVous">

				<i class="titleIcon mt-5 mx-auto fa-3x fa-solid fa-user"></i>
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

				<router-link to="/inscription"><button class="btn btn-lg mt-3 rounded-pill">Je m'inscris</button>
				</router-link>
			</section>

		</div>
	</div>

	<!-- **************************************** FOOTER ******************************************** -->

	<Footer />

</template>

<style scoped>
img {
	height: 1.7em
}

.titleIcon {
	color: #94D1BE
}

h2 {
	color: #1c6e8c
}

.btn {
	background-color: #94D1BE !important;
	color: white;
}

#presentation {
	background-position: center;
	background-size: cover;
	height: 55vh
}

#presentationTopStripe {
	background-color: #94D1BE;
	height: 2vh;
}

#presentationBottomStripe {
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

.infosTopLieux,
.infosDerniersLieux {
	background-color: rgba(50, 61, 158, 0.5);
	height: 34%
}

.ranking {
	font-size: 2em;
}

.rankingAndName {
	height: 70%
}

.yellowStar {
	color: yellow
}

.categoryicon {
	background-color: white;
}

#inscrivezVous {
	color: #1c6e8c;
}

.inscrivezVousIcones {
	width: 10vw;
	height: 10vw
}

#pointer {
	width: 7vw;
	height: 10vw
}

@media screen and (max-width: 380px){
	#toplieux .rounded-circle {
		display: none;
	}
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
		height: 85vh;
	}

	#presentation {
		height: 57vh
	}
	
	.infosTopLieux {
		height: 55%
	}

	.infosDerniersLieux {
		height: 60%
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

@media screen and (max-width: 992px) {

	.infosTopLieux {
		height: 40%
	}

	.infosDerniersLieux {
		height: 45%
	}
}

@media screen and (min-width: 993px){
	.infosDerniersLieux {
		height: 35%
	}
}
</style>