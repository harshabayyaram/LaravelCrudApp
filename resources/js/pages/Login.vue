<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { auth } from '../functions/Auth'

const router = useRouter()

const form = ref({
    email: '',
    password: ''
})

const errors = ref({})

const login = async () => {
    errors.value = {} // reset previous errors

    try {
        const response = await axios.post('/api/login', form.value)

        // localStorage.setItem('token', response.data.token)
        auth.setToken(response.data.token)
        axios.defaults.headers.common['Authorization'] =
            `Bearer ${response.data.token}`

        router.push('/')
    } catch (e) {
        if (e.response?.status === 422) {
            errors.value = e.response.data.errors || {}
        } else if (e.response?.status === 401) {
            errors.value.general = ['Invalid credentials']
        } else {
            errors.value.general = ['Something went wrong']
        }
    }
}
</script>

<template>
    <div class="container mt-5 col-md-4">
        <h3>Login</h3>

        <!-- General errors -->
        <div v-if="errors.general" class="alert alert-danger">
            <div v-for="(err, i) in errors.general" :key="i">{{ err }}</div>
        </div>

        <!-- Email input -->
        <div class="mb-2">
            <input v-model="form.email" class="form-control" placeholder="Email" />
            <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
        </div>

        <!-- Password input -->
        <div class="mb-3">
            <input v-model="form.password" type="password" class="form-control" placeholder="Password" />
            <small v-if="errors.password" class="text-danger">{{ errors.password[0] }}</small>
        </div>

        <button class="btn btn-primary w-100" @click="login">Login</button>
    </div>
</template>
