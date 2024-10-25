<template>
    <div class="col-lg-6">
        <div class="p-5 shadow rounded-3 text-center">
            <i class="bi bi-file-earmark-ruled me-1 text-purple icon"></i>
            <h1 class="mb-0"><strong>{{ terms }}</strong></h1>
            <p class="mt-0 h5">Terms</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        terms: {
            type: Number,
            required: true,
        },
    },
};
</script>

<style scoped>
.text-purple {
    color: #6B4EB7;
}

.icon {
    -size: 4rem;
}
</style>