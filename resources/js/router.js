import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        Path: "/",
        component: () => import("./pages/HomeRoute.vue"),
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
