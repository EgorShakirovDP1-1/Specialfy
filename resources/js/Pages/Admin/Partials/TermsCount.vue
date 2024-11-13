<template>
    <div class="col-lg-6">
        <div class="panel p-4 shadow rounded-3 text-center">
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
.panel {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.text-purple {
    color: #6B4EB7;
}
.icon {
    font-size: 4rem;
}
</style>