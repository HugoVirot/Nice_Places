<script>
import { store } from "../store.js";

export default {

    data() {
        return {
            message: store.getters.getMessage
        }
    },
    mounted() {
        setTimeout(() => this.$router.push('/'), 3000)
    }
}
</script>

<style scoped>
.container-fluid {
    background-color: #94D1BE
}
</style>

<template>

    <div class="container-fluid text-center p-5 m-5 text-white">
        <h3 class="p-5">Félicitations</h3>
        <i class="p-5 fa-solid fa-check fa-5x"></i>
        <h2 class="p-5">{{ message }}</h2>
    </div>

</template>