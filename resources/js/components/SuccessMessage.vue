<script>
import { store } from "../store.js";

export default {

    data() {
        return {
            message: store.state.message
        }
    },
    mounted() {
        setTimeout(() => this.$router.push('/'), 2500)
    }
}
</script>

<style scoped>
.container-fluid {
    background-color: #94D1BE
}
</style>

<template>

    <div class="container-fluid text-center py-5 my-5 text-white">
        <h3 class="p-2">Félicitations</h3>
        <i class="fa-solid fa-circle-check fa-5x p-2"></i>
        <h2 class="p-2">{{ message }}</h2>
    </div>

</template>