<template>

	<div v-if="lieu">

		<div class="pt-5 pb-2">
			<i class="titleIcon mx-auto fa-3x fa-solid fa-map-location-dot"></i>
			<h1 class="mt-2">{{ lieu.nom }}</h1>
			<p class="rating fs-3">
			<div class="mx-auto"><i id="star" class="fa-solid fa-star ms-2 me-1"></i>
				{{ lieu.note }}</div>
			</p>
			<p><i class="fa-solid fa-user fa-2x ms-2 me-3"></i>Posté par {{ lieu.user.pseudo }}</p>
		</div>



		<img class="singlePicture" v-if="lieu.images.length == 1" :src="`/images/${lieu.images[0].nom}`">

		<div v-else id="carouselLieu" class="carousel slide carousel-fade container" data-bs-ride="carousel">

			<div class="carousel-inner">

				<div v-for="(image, index) in lieu.images" :class="['carousel-item', { active: index == 0 }]">
					<img :src="`/images/${image.nom}`" class="d-block w-100" alt="">
				</div>

				<div class="carousel-indicators">
					<button v-for="(image, index) in lieu.images" type="button" data-bs-target="#carouselLieu"
						:data-bs-slide-to="index" :class="{ active: index == 0 }" aria-current="true"
						:aria-label="`Slide ${index + 1}`">
					</button>
				</div>

			</div>

			<button class="carousel-control-prev" type="button" data-bs-target="#carouselLieu" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>

			<button class="carousel-control-next" type="button" data-bs-target="#carouselLieu" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>

		<div id="detailsLieu" class="container p-4">

			<p class="m-3">{{ lieu.description }}</p>

			<div class="row px-5 py-4 mt-4 border border-primary">
				<div class="col-md-6">
					<p> <i class="fa-2x fa-solid fa-road me-3"></i>
						{{ lieu.adresse }}</p>
					<p> <i class="fa-2x fa-solid fa-location-dot me-3"></i>
						{{ lieu.code_postal + " " + lieu.ville.toUpperCase() }}</p>
					<p> <i class="fa-2x fa-solid fa-hourglass me-3"></i>
						{{ lieu.temps }} heures
					</p>
					<p><i class="fa-2x fa-solid fa-gauge-simple-high me-3"></i>
						{{ lieu.difficulte }}
					</p>
				</div>
				<div class="col-md-6">
					<p><i class="fa-2x fa-solid fa-earth-europe me-3"></i>
						latitude : {{ lieu.latitude }}
					</p>
					<p><i class="fa-2x fa-solid fa-earth-europe me-3"></i>
						longitude : {{ lieu.longitude }}
					</p>
					<p><i class="fa-2x fa-solid fa-star me-3"></i>
						{{ lieu.note }} / 10
					</p>
					<p v-if="lieu.kilometres"> <i class="fa-2x fa-solid fa-shoe-prints me-3"></i>
						{{ lieu.kilometres }} kilomètres environ (moyenne)</p>
				</div>
			</div>
		</div>

	</div>
</template>

<script>
import axios from 'axios'

export default {

	data() {
		return {
			lieuId: this.$route.params.id,
			lieu: ''
		}
	},

	created() {

		axios.get('/api/lieus/' + this.lieuId)

			.then((response) => {
				// on stocke le message de succès dans le store ("inscription réussie")
				console.log(response.data)
				this.lieu = response.data
			})

			.catch((error) => {
				this.validationErrors = error.response.data.data;
			})
	}
}</script>

<style scoped>
.titleIcon {
	color: #94D1BE
}

h1,
.rating {
	color: #1C6E8C
}

.singlePicture {
	width: 90vw
}

p {
	color: grey
}

i {
	color: #1C6E8C
}

#star {
	color: yellow
}

#detailsLieu p {
	display: flex;
	align-items: center
}
</style>