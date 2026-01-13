<template>
    <div class="bg-app text-white">
        <BOrchestrator />
        <Navbar />
        <router-view v-slot="{ Component }">
            <component :is="Component" />
        </router-view>
    </div>
</template>

<script setup>
import { BOrchestrator } from 'bootstrap-vue-next'
import Navbar from './pages/Navbar.vue';
</script>

<style>
* {
    box-sizing: border-box;
}

html,
body {
    margin: 0 !important;
    padding: 0 !important;
    height: 100%;
}

#app {
    min-height: 100%;
}

.bg-app {
    min-height: 100vh;
    height: 100dvh;    
    display: block;
    object-fit: fill;
    background: radial-gradient(circle, #0a0f2c 0%, #07102a 70%, #000018 100%);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>