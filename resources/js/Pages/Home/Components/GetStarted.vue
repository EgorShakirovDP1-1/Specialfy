<template>
    <section class="p-lg-5 bg-light mt-5" aria-labelledby="getStartedHeading">
        <div class="container p-4">
            <div class="row justify-content-between align-items-center">
                <div class="text-warning col-lg-6">
                    <h1 class="text-warning" id="getStartedHeading">Easy to get started!</h1>
                    <p class="lead .text-black">1.Registrate account!</p>
                    <p class="lead .text-black">2. Choose and pay or watch community posts!</p>
                    <p class="lead .text-black">3. Enjoy!</p>
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