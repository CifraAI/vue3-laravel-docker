<template>
    <h1>Product</h1>

    {{ product }}

</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials = true

import {ref} from "vue";

export default {
    name: 'Product',

    beforeCreate() {
        this.load()
    },

    setup() {

        let product = {
            title: null,
            description: null,
            price: 0
        }

        function onSuccess(response) {
            product = response.data;
        }

        function load() {
            axios.get('/api/products/' + this.$route.params.id)
                .then(onSuccess)
                .catch((error) => { alert(`Error ${error.message}`) })
        }

        return {
            load,
            product
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
    margin: 40px 0 0;
}
a {
    color: #42b983;
}
ul {
    text-align: start;
}
button {
    font-size: 1.1rem;
    cursor: pointer;
}
.server-response {
    display: inline-block;
}
.server-response h2 {
    text-align: start;
    margin-top: 0;
}
</style>
