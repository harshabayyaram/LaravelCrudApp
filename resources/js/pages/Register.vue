<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { auth } from '../functions/Auth'

const router = useRouter()

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const errors = ref({})

const register = async () => {
    errors.value = {}
    try {
        const res = await axios.post('/api/register', form.value)

        // localStorage.setItem('token', res.data.token)
        auth.setToken(res.data.token)
        axios.defaults.headers.common['Authorization'] =
            `Bearer ${res.data.token}`

        router.push('/')
    } catch (e) {
        if (e.response?.status === 422) {
            errors.value = e.response.data.errors || {}
        } else {
            errors.value.general = ['Something went wrong']
        }
    }
}
</script>
<template>
<div class="container mt-5 col-md-4">
    <h3>Register</h3>

    <!-- General errors (optional) -->
    <div v-if="errors.general" class="alert alert-danger">
        <div v-for="(err, i) in errors.general" :key="i">{{ err }}</div>
    </div>

    <!-- Name input -->
    <div class="mb-2">
        <input v-model="form.name" class="form-control" placeholder="Name" />
        <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
    </div>

    <!-- Email input -->
    <div class="mb-2">
        <input v-model="form.email" class="form-control" placeholder="Email" />
        <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
    </div>

    <!-- Password input -->
    <div class="mb-2">
        <input v-model="form.password" type="password" class="form-control" placeholder="Password" />
        <small v-if="errors.password" class="text-danger">{{ errors.password[0] }}</small>
    </div>

    <!-- Password confirmation input -->
    <div class="mb-3">
        <input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Confirm Password" />
        <small v-if="errors.password_confirmation" class="text-danger">{{ errors.password_confirmation[0] }}</small>
    </div>

    <button class="btn btn-success w-100" @click="register">Register</button>
</div>
</template>