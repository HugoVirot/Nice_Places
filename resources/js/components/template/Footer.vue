<template>
    <footer class="container-fluid greenBackground text-center p-5 mt-5">
        <img id="logoFooter" src="images/logo2.png">
        <p class="text-white fs-4">sorties nature près de chez vous</p>
        <p><a href="/">mentions légales</a> | <a href="/">politique de confidentialité</a></p>
        <p>© 2022 Nice Places</p>
    </footer>
</template>

<script>
export default {
}
</script>

<style>

footer p {
    color: #1C6E8C
}

#logoFooter {
    width: 30vw
}

@media screen and (min-width: 769px) and (max-width: 1024px) {
    #logoFooter {
        width: 50vw
    }
}

@media screen and (max-width: 768px) {
    #logoFooter {
        width: 70vw
    }
}
</style>
