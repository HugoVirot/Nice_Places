
<template>
    <div class="p-5">
        <i class="greenIcon fa-solid fa-3x fa-book-atlas"></i>
        <h1 class="mt-2">Catégories</h1>
    </div>

    <div class="container-fluid p-3 p-lg-5">
        <div class="row">
            <div class="col-lg-6 border border-3 border-white card text-white" v-for="(categorie, index) in categories"
                :key="categorie.id"
                :style="`background-image: url(images/categorie${categorie.id}.jpg); background-position: center; background-size: cover;`">

                <span class="m-auto">
                    <div class="p-3 textWithShadow bigFontSize"> {{ categorie.nom }} </div>
                    <router-link :to="`/categories/${categorie.id}`"><button class="btn btn-lg">Voir</button>
                    </router-link>
                </span>

            </div>
        </div>
    </div>

</template>

<script>
import { store } from "../../store.js";

export default {
    computed: {
        categories() {
            return store.state.categories
        }
    }

}
</script>

<style scoped>
.greenIcon {
    color: #94D1BE
}

h1,
h2 {
    color: #1C6E8C
}

.textWithShadow {
    text-shadow: 2px 2px 4px #1C6E8C;
}

.bigFontSize {
    font-size: 3.5em;
}

.card {
    height: 35vh
}

button {
    background-color: #94DEB1;
    color: white
}

button:hover {
    background-color: #1C6E8C;
    color: white
}

@media screen and (max-width: 568px) {
    .bigFontSize {
        font-size: 2.5em;
    }
}
</style>