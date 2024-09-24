<template>
    <section class="p-0 p-lg-5 my-5" aria-labelledby="parkingSectionHeading">
        <div class="container mt-4">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <img class="img-fluid rounded img-zoom" :src="watchImage" alt="" aria-hidden="true" />
                </div>
                <div class="col-lg-6 mt-3 mt-lg-0">
                    <h1 class="text-primary" id="parkingSectionHeading">
                        Something <span class="text-warning">Something!</span>
                    </h1>
                    <p class="lead text-primary">
Blah blah suck my balls
                    </p>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
export default {
    props: {
        watchImage: {
            type: String,
            required: true,
        },
    },
};
</script>

<style></style>
