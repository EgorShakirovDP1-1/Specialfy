<template>
    <div>
        <Navbar />
        <slot />
        <Footer />
    </div>
</template>

<script>
import Navbar from "./Components/Navbar.vue";
import Footer from "./Components/Footer.vue";

export default {
    components: {
        Navbar,
        Footer,
    },
};
</script>

<style>
body::-webkit-scrollbar {
    display: none;
}

.img-zoom {
    transition: 0.3s;
}
  
.img-zoom:hover {
    transform: scale(1.03);
}
</style>
