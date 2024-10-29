<template>
    <footer class=" text-white text-center p-4 footer">
        <div class="container">

            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item">
                    <Link :href="route('home')" class="nav-link px-2 text-black" aria-label="home page">Home</Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('indexpriv')" class="nav-link px-2 text-black" aria-label="indexpriv policy page">indexpriv policy</Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('terms')" class="nav-link px-2 text-black"
                        aria-label="terms and conditions page">Terms</Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('posts')" class="nav-link px-2 text-black" aria-label="posts page">Listings</Link>
                </li>
                <li v-if="$page.props.auth" class="nav-item">
                    <Link :href="route('profile', { user: $page.props.auth })" class="nav-link px-2 text-black"
                        aria-label="profile page">Profile</Link>
                </li>
                <li v-if="!$page.props.auth" class="nav-item">
                    <Link :href="route('login')" class="nav-link px-2 text-black" aria-label="login page">Login</Link>
                </li>
            </ul>
            <p class="lead text-black">
                
                <span class="text-black">Copyright © 2024 MVTEK Group</span>
            </p>
        </div>
    </footer>
</template>


<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        auth: Object,
    },
};
</script>

<style scoped>


</style>
