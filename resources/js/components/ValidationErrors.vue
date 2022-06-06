<script>
export default {
    props: ['errors'],
    computed: {
        validationErrors() {
            // on récupère les messages d'erreur
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }
    }
}
</script>

<template>
    <div v-if="validationErrors">
        <ul class="alert alert-danger">
            <li v-for="(value, key, index) in validationErrors">{{ value }}</li>
        </ul>
    </div>`
</template>