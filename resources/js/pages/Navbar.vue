<script setup>
import { computed } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()

const isAuthenticated = computed(() => {
    return !!localStorage.getItem('token')
})

const logout = async () => {
    try {
        await axios.post('api/logout')
    } catch (e) {
        console.log(e);
        
    }

    localStorage.removeItem('token')
    delete axios.defaults.headers.common['Authorization']

    router.push('/login')
}
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">Asset Manager</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li v-if="!isAuthenticated" class="nav-item">
                    <router-link class="nav-link" to="/login">Login</router-link>
                </li>

                <li v-if="!isAuthenticated" class="nav-item">
                    <router-link class="nav-link" to="/register">Register</router-link>
                </li>

                <li v-if="isAuthenticated" class="nav-item">
                    <button class="btn btn-danger btn-sm" @click="logout">
                        Logout
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</template>
