<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref(null)
const router = useRouter()

const login = async () => {
    try {
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value
        })

        localStorage.setItem('token', response.data.token)
        axios.defaults.headers.common['Authorization'] =
            `Bearer ${response.data.token}`

        router.push('/')
    } catch (e) {
        error.value = 'Invalid credentials'
    }
}
</script>

<template>
    <div class="container mt-5 col-md-4">
        <h3>Login</h3>

        <div v-if="error" class="alert alert-danger">{{ error }}</div>

        <input v-model="email" class="form-control mb-2" placeholder="Email" />
        <input v-model="password" type="password" class="form-control mb-3" placeholder="Password" />

        <button class="btn btn-primary w-100" @click="login">Login</button>
    </div>
</template>
