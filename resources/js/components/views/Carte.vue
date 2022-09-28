<script>
import Map from "../utilities/Map.vue"

export default {
    components: { Map }
}
</script>

<template>
    <section>
        <div class="pt-5 pb-4">
            <i class="mx-auto fa-3x fa-solid fa-paper-plane"></i>
            <h1 class="mt-2">Carte des lieux</h1>
        </div>

        <Map />
    </section>
</template>

<style>
h1 {
    color: #1C6E8C
}

.greenIcon {
    color: #94DEB1
}

i {
    color: #94D1BE
}
</style>