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
                      
                        <!-- LOGO -->
                        <ul class="navbar-nav">
                            <li class="nav-item d-flex align-items-start my-2">
                                <Link :href="route('home')" aria-label="home page">
                                    <img class="logo" src="/public/images/logo.png" >
                                </Link> 
                            </li>
                        </ul>


                        <ul class="navbar-nav">
                            <!-- TERMS -->
                            <li class="nav-item d-flex align-items-center me-4 my-2 my-lg-0">
                                <Link :href="route('terms')" class="nav-link p-1"
                                    :class="{
                                        'text-black': !$page.url.includes('/terms'),
                                        'text-white': $page.url.includes('/terms'),
                                    }"
                                    aria-label="rental terms page">
                                        <i class="bi bi-info-circle"
                                        :class="{
                                            'text-black': !$page.url.includes('/terms'),
                                            'text-white': $page.url.includes('/terms'),
                                        }"
                                        aria-label="rental terms icon">
                                        </i>
                                    Terms
                                </Link>
                            </li>

                            <!-- PRIVACY POLICY -->
                            <li class="nav-item d-flex align-items-center me-4 my-2 my-lg-0">
                                <Link :href="route('privacy')" class="nav-link p-1"
                                    :class="{
                                        'text-black': !$page.url.includes('/privacy'),
                                        'text-white': $page.url.includes('/privacy'),
                                    }"
                                    aria-label="privacy policy link">
                                        <i class="bi bi-file-earmark-ruled"
                                        :class="{
                                            'text-black': !$page.url.includes('/privacypolicy'),
                                            'text-white': $page.url.includes('/privacypolicy'),
                                        }"
                                        aria-label="our privacy policy icon">
                                        </i>
                                    Privacy Policy
                                </Link>
                            </li>

                            <!-- POSTS -->
                           

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
                            <!-- PROFILE PAGE -->
                            <li v-if="$page.props.auth"
                            class="nav-item d-flex align-items-center me-4 my-2 my-lg-0">
                                <Link :href="route('profile', { user: $page.props.auth })" class="nav-link p-1"
                                    :class="{
                                        'text-black': !$page.url.includes('/profile'),
                                        'text-white': $page.url.includes('/profile'),
                                    }"
                                    aria-label="profile page link">
                                        <i class="bi bi-person-circle"
                                        :class="{
                                            'text-black': !$page.url.includes('/profile'),
                                            'text-white': $page.url.includes('/profile'),
                                        }" 
                                        aria-label="profile page icon">
                                        </i>
                                    Profile Page
                                </Link>
                            </li>

                            <!-- ADMIN PANEL -->
                            <!-- ADMIN PANEL -->
                            <li v-if="$page.props.auth && $page.props.isAdmin"
                            class="nav-item d-flex align-items-center me-4 my-2 my-lg-0">
                                <Link :href="route('admin')" class="nav-link p-1"
                                    :class="{
                                        'text-black': !$page.url.includes('/admin'),
                                        'text-white': $page.url.includes('/admin'),
                                    }"
                                    aria-label="admin panel">
                                        <i class="bi bi-gear-fill"
                                        :class="{
                                            'text-black': !$page.url.includes('/admin'),
                                            'text-white': $page.url.includes('/admin'),
                                        }"
                                        aria-label="admin panel icon">
                                        </i>
                                    Admin Panel
                                </Link>
                            </li>

                            <!-- LOG OUT -->
                            <!-- LOG OUT -->
                            <li v-if="$page.props.auth" class="nav-item d-flex align-items-center my-2 my-lg-0 me-0">
                                <Link :href="route('logout')" class="nav-link p-1 text-black" aria-label="log out">
                                    <i class="bi bi-box-arrow-right text-black"
                                    aria-label="log out icon"></i>
                                    Log Out
                                </Link>
                            </li>

                            <!-- LOG IN -->
                            <li v-if="!$page.props.auth" class="nav-item d-flex align-items-center me-4 my-2 my-lg-0"> 
                                <Link :href="route('login')" class="nav-link p-1"
                                :class="{
                                    'text-black': !$page.url.includes('/login'),
                                    'text-white': $page.url === '/login',
                                }" 
                                aria-label="log in">
                                    <i class="bi bi-box-arrow-in-right"
                                    :class="{
                                        'text-black': !$page.url.includes('/login'),
                                        'text-white': $page.url.includes('/login'),
                                    }" 
                                    aria-label="log in icon">
                                        </i>
                                    Log In
                                </Link>
                            </li>

                            <!-- SIGN UP -->
                            <li v-if="!$page.props.auth" class="nav-item d-flex align-items-center me-4 my-2 my-lg-0">
                                
                                    <Link :href="route('register')" class="nav-link p-1"
                                    :class="{
                                        'text-black': !$page.url.includes('/register'),
                                        'text-white': $page.url.includes('/register'),
                                    }" aria-lasticky-topbel="register">
                                    <i class="bi bi-box-arrow-in-up"
                                        :class="{
                                            'text-black': !$page.url.includes('/register'),
                                            'text-white': $page.url.includes('/register'),
                                        }"
                                        aria-label="register icon">      
                                        </i>
                                    Sign up
                                </Link>
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
    font-size: 14px;

}
</style>