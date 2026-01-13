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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Asset Manager</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <!-- Use auth.isAuthenticated() for reactivity -->
                <li v-if="!auth.isAuthenticated()" class="nav-item">
                    <router-link class="nav-link" to="/login">Login</router-link>
                </li>

                <li v-if="!auth.isAuthenticated()" class="nav-item">
                    <router-link class="nav-link" to="/register">Register</router-link>
                </li>

                <li v-if="auth.isAuthenticated()" class="nav-item">
                    <button class="btn btn-danger btn-sm" @click="logout">
                        Logout
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</template>
