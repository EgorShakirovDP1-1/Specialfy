<template>
    <section class="p-lg-5 bg-light pt-3 my-4" aria-labelledby="mobilityApproach">
        <div class="container mt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img class="img-fluid rounded img-zoom" :src="twentycentuaryfoxImage" alt="" />
                </div>
                <div class="col-lg-6">
                    <h1 id="mobilityApproach" class="text-black">
                        <span class="text-warning">A new approach</span> to
                        service     industry!
                    </h1>
                    <p class="lead .text-black">
                        Specialfy aims to provide a easy to use service providing system where users can search or put their services up for people to use!
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        twentycentuaryfoxImage: {
            type: String,
            required: true
        }
    }
};
</script>

<style></style>
