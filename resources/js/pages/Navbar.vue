<script setup>
import { auth } from '../functions/Auth'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const logout = async () => {
    try {
        await axios.post('/api/logout')
    } catch (e) {
        console.log(e)
    }

    auth.clearToken()
    delete axios.defaults.headers.common['Authorization']
    router.push('/login')
}
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom px-4">
        <a class="navbar-brand" href="#">Assets Management</a>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav align-items-center">
                <li v-if="!auth.isAuthenticated()" class="nav-item mx-2">
                    <router-link class="nav-link btn btn-outline-light px-4 py-2" to="/login">
                        Login
                    </router-link>
                </li>

                <li v-if="!auth.isAuthenticated()" class="nav-item mx-2">
                    <router-link class="nav-link btn btn-outline-primary px-4 py-2" to="/register">
                        Register
                    </router-link>
                </li>

                <li v-if="auth.isAuthenticated()" class="nav-item mx-2">
                    <button class="btn btn-danger px-4 py-2" @click="logout">
                        Logout
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</template>

<style scoped>

.navbar-custom {
    background: rgba(10, 15, 44, 0.85);
    backdrop-filter: blur(5px);
    padding: 0.75rem 2rem;

    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    .navbar-custom {
    background: rgba(6, 9, 28, 0.85);
    backdrop-filter: blur(5px); 
    padding: 0.75rem 2rem;
    border-bottom: 1px solid rgba(200, 177, 177, 0.1);
}
}

.navbar-brand {
    font-size: 1.6rem;
    font-weight: bold;
    color: #ffffff !important;
}

.navbar-nav .nav-link {
    font-size: 0.95rem;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    border-radius: 5px;
}

.navbar-nav .nav-link:hover {
    transform: translateY(-2px);
    text-decoration: none;
}

.btn-outline-light {
    border: 1px solid #ffffff;
    color: #ffffff;
}

.btn-outline-light:hover {
    background-color: #ffffff;
    color: #0a0f2c;
}

.btn-outline-primary {
    border: 1px solid #1e3a8a;
    color: #1e3a8a;
}

.btn-outline-primary:hover {
    background-color: #1e3a8a;
    color: #ffffff;
}

.btn-danger {
    background-color: #d63e3e;
    border: none;
}

.btn-danger:hover {
    background-color: #991b1b;
}
</style>
