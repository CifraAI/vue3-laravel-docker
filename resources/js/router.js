import { createWebHistory, createRouter } from "vue-router";
import Home from "@/views/Home.vue";
import About from "@/views/About.vue";
import Error404 from "@/views/Error404.vue";
import Catalog from "@/views/Catalog.vue";
import Product from "@/views/Product.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/catalog",
        name: "CatalogIndex",

        children: [
            {
                path: "",
                name: "Catalog",
                component: Catalog,
            },
            {
                path: ":id",
                name: "Product",
                component: Product,
            }
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'Error404',
        component: Error404,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
