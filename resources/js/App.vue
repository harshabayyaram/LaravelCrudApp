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
    height: 100vh;
    display: block;
    object-fit: fill;
    background: url('/public/images/futuristic-style-digital-technology-square-background-free-vector.jpg') center / cover no-repeat;
}
</style>