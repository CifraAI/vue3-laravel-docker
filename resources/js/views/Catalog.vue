<template>
    <h1>Catalog</h1>

    <button @click="load" v-if="products.length === 0">Load data from server</button>

    <div class="server-response" v-if="products.length > 0">
        <h2>Data from server:</h2>
        <ul>
            <li v-for="item in products" :key="item.id">
                <router-link :to="{ name: 'Product', params: { id: item.id } }">{{ item.title }}</router-link>
            </li>
        </ul>
    </div>

</template>

<script>
import axios from 'axios'
axios.defaults.withCredentials = true

import {ref} from "vue";

export default {
    name: 'Catalog',

    beforeCreate() {
        this.load()
    },

    setup() {

        const products = ref([])

        function onSuccess(response) {
            products.value = response.data.products;
        }

        function load() {
            axios.get('/api/products')
                .then(onSuccess)
                .catch((error) => { alert(`Error ${error.message}`) })
        }

        return {
            load,
            products
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
