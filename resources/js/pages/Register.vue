<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const register = async () => {
    const res = await axios.post('/api/register', form.value)

    localStorage.setItem('token', res.data.token)
    axios.defaults.headers.common['Authorization'] =
        `Bearer ${res.data.token}`

    router.push('/')
}
</script>

<template>
    <div class="container mt-5 col-md-4">
        <h3>Register</h3>

        <input v-model="form.name" class="form-control mb-2" placeholder="Name" />
        <input v-model="form.email" class="form-control mb-2" placeholder="Email" />
        <input v-model="form.password" type="password" class="form-control mb-2" placeholder="Password" />
        <input v-model="form.password_confirmation" type="password" class="form-control mb-3"
            placeholder="Confirm Password" />

        <button class="btn btn-success w-100" @click="register">Register</button>
    </div>
</template>
