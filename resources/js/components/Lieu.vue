<template>
	<h1>Page du lieu</h1>
	<!-- <div class="col-2 d-flex justify-content-center align-items-center">
									<div v-for="category in topPlace.categories">
										<span class="text-info bg-white rounded-circle py-1 px-2"
											v-html="category.icone"></span>
									</div>
								</div> -->
	{{ lieuId }}
</template>

<script>
export default {
	data() {
		return {
			lieuId: this.$route.params.id
		}
	}, created() {
		console.log(this.lieuId)
	}
}</script>