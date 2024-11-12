<template>
    <section class="p-lg-5 bg-light mt-5" aria-labelledby="getStartedHeading">
        <div class="container p-4">
            <div class="row justify-content-between align-items-center">
                <div class="text-warning col-lg-6">
                    <h1 class="text-black" id="getStartedHeading">Easy to get <span class="text-danger">started!</span></h1>
                    <p class="lead text-black">1. <span class="text-danger">Register</span> an account!</p>
                    <p class="lead text-black">2. Choose to <span class="text-danger">search or provide</span> a service!</p>
                    <p class="lead text-black">3. <span class="text-danger">Enjoy!</span></p>
                </div>
                <div id="carouselPosts" class="ousel slide col-lg-6" data-bs-ride="ousel" aria-hidden="true">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img :src="getStartedURLs[0]" class="img-fluid zoom-effect rounded" alt="">
                        </div>
                        <div class="carousel-item">
                            <img :src="getStartedURLs[1]" class="img-fluid rounded" alt="">
                        </div>
                        <div class="carousel-item">
                            <img :src="getStartedURLs[2]" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        getStartedURLs: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped></style>