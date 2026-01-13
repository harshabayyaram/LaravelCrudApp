import { createRouter, createWebHistory } from "vue-router";
import Login from "./pages/Login.vue";
import HomeRoute from "./pages/HomeRoute.vue";
import Register from "./pages/Register.vue";

const routes = [
    { path: "/login", component: Login },
    { path: '/register', component: Register },
    {
        path: "/",
        // component: () => import("./pages/HomeRoute.vue"),
        component: HomeRoute,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')

    if (to.meta.requiresAuth && !token) {
        next('/login')
    } else {
        next()
    }
})

export default router;