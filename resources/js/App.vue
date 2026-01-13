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


/* .bg-app {
    height: 100vh;
    display: block;
    object-fit: fill;
    background: url('/public/images/futuristic-style-digital-technology-square-background-free-vector.jpg') center / cover no-repeat;
} */

.bg-app {
    height: 100vh;
    display: block;
    object-fit: fill;

    /* Dark radial gradient: center dark gray to edges black */
    background: radial-gradient(circle, #0a0f2c 0%, #07102a 70%, #000018 100%);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>