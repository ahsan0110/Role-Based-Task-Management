<template>
    <Header />
    <div class="home-page">

        <div class="hero">
            <h1>Welcome to Task Management</h1>
            <p>Manage your tasks efficiently, assign them to team members, and track progress in real-time.</p>


        </div>

        

        <section class="about">
            <h2>About This App</h2>
            <p>This is a simple yet powerful task management system built with Laravel 12 (backend) and Vue 3 + Vite
                (frontend).
                It’s perfect for learning full-stack development or managing small teams.</p>
        </section>
        <div class="buttons">
            <router-link to="/register">
                <button class="btn">Register</button>
            </router-link>
            <router-link to="/login">
                <button class="btn">Login</button>
            </router-link>
        </div>
    </div>
</template>

<script>
import Header from '../components/Header.vue'

export default {
    components: {
        Header
    }
}
</script>
