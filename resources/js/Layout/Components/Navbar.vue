<template>
    <section class="sticky-top">
        <div class="container ps-0 pe-0">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid px-0">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                      
                        <!-- LOGO -->
                        <ul class="navbar-nav">
                            <li class="nav-item d-flex align-items-start my-2">
                                <Link :href="route('home')" aria-label="home page">
                                    <img class="logo" src="/public/images/logo.png" >
                                </Link> 
                            </li>
                        </ul>

                        <ul class="navbar-nav">
                            <li class="nav-item d-flex align-items-center me-5 my-3 my-lg-0">
                                <Link :href="route('terms')" class="nav-link p-1" :class="{
                                    'text-secondary': !$page.url.includes('/terms'),
                                    'text-black': $page.url.includes('/terms'),
                                }" aria-label="rental terms page">
                                <i class="bi bi-file-earmark-ruled" :class="{
                                    'text-secondary': !$page.url.includes('/terms'),
                                    'text-black': $page.url.includes('/terms'),
                                }" aria-label="rental terms icon"></i>Terms
                                </Link>
                            </li>
                            <li class="nav-item d-flex align-items-center me-3 my-2 my-lg-0">
                                
                                <i class="bi bi-list text-black" aria-label="our post list icon"></i>
                                <Link :href="route('posts')" class="nav-link p-1" :class="{
                                    'text-secondary': $page.url !== '/posts',
                                    'text-black': $page.url === '/posts',
                                }"
                                aria-label="our post list page">
                                </Link>
                                <Link :href="route('indexpriv')" class="nav-link p-1" :class="{
                                    'text-secondary': $page.url !== '/posts',
                                    'text-black': $page.url === '/posts',
                                }"
                                aria-label="our post list page">приваси полиси
                                </Link>
                            </li>

                            <!-- POSTS -->
                            <li class="nav-item d-flex align-items-center me-4 my-2 my-lg-0">
                                <Link :href="route('posts')" class="nav-link p-1"
                                    :class="{
                                        'text-black': !$page.url.includes('/Posts'),
                                        'text-white': $page.url.includes('/Posts'),
                                    }"
                                    aria-label="post link">
                                        <i class="bi bi-list"
                                        :class="{
                                            'text-black': !$page.url.includes('/Posts'),
                                            'text-white': $page.url.includes('/Posts'),
                                        }"
                                        aria-label="our post list icon">
                                        </i>
                                    Listings
                                </Link>
                            </li>

                            <!-- PROFILE PAGE -->
                            <li v-if="$page.props.auth"
                                class="nav-item d-flex align-items-center ms-0 ms-lg-4 me-3 my-2 my-lg-0">
                                <i class="bi bi-person-circle text-black" aria-label="profile page icon"></i>
                                <Link :href="route('profile', { user: $page.props.auth })" class="nav-link p-1" :class="{
                                    'text-secondary': !$page.url.includes('/profile'),
                                    'text-black': $page.url.includes('/profile'),
                                }" aria-label="profile page">Profile Page</Link>
                            </li>

                            <!-- ADMIN PANEL -->
                            <li v-if="$page.props.auth && $page.props.isAdmin"
                                class="nav-item d-flex align-items-center ms-0 me-3 my-2 my-lg-0">
                                <i class="bi bi-gear-fill text-black" aria-label="admin panel icon"></i>
                                <Link :href="route('admin')" class="nav-link p-1 text-black" :class="{
                                    'text-secondary': !$page.url.includes('/admin'),
                                    'text-black': $page.url.includes('/admin'),
                                }" aria-label="admin panel">Admin Panel</Link>
                            </li>

                            <!-- LOG OUT -->
                            <li v-if="$page.props.auth" class="nav-item d-flex align-items-center my-2 my-lg-0 me-0">
                                <i class="bi bi-box-arrow-right text-black" aria-label="log out icon"></i>
                                <Link :href="route('logout')" class="nav-link p-1 text-black" aria-label="log out">Log
                                Out</Link>
                            </li>

                            <li v-if="!$page.props.auth" class="nav-item d-flex align-items-center my-2 my-lg-0">
                                <i class="bi bi-box-arrow-in-right text-black ms-0 ms-lg-5"
                                    aria-label="log in icon"></i>
                                <Link :href="route('login')" class="nav-link p-1" :class="{
                                    'text-secondary': !$page.url.includes('/login'),
                                    'text-black': $page.url === '/login',
                                }" aria-label="log in">Log In</Link>
                            </li>

                            <li v-if="!$page.props.auth" class="nav-item d-flex align-items-center my-2 my-lg-0">
                                <i class="bi bi-box-arrow-in-left text-black" aria-label="register icon"></i>
                                <Link :href="route('register')" class="nav-link p-1" :class="{
                                    'text-secondary': !$page.url.includes('/register'),
                                    'text-black': $page.url === '/register',
                                }" aria-lasticky-topbel="register">Sign up</Link>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>
</template>
<script>
import { Link } from "@inertiajs/vue3";
export default {
    components: {
        Link,
    },
};
</script>

<style>
.sticky-top{
    background-color: rgb(240, 70, 70);
}
.logo{
    height: 70px;
    width: auto;
}
.nav-item{
    font-size: 17px;

}
</style>