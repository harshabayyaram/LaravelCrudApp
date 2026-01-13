import { reactive } from 'vue'

export const auth = reactive({
    token: localStorage.getItem('token') || null,
    
    isAuthenticated() {
        return !!this.token
    },

    setToken(token) {
        this.token = token
        localStorage.setItem('token', token)
    },

    clearToken() {
        this.token = null
        localStorage.removeItem('token')
    }
})
