<template>
    <div class="col-lg-6">
        <div class="panel p-4 rounded-3 shadow text-center">
            <i class="bi bi-camera2 text-info icon"></i>
            <h1 class="mb-0"><strong>{{ posts }}</strong></h1>
            <p class="mt-0 h5">Listings</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        posts: {
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
.icon {
    font-size: 4rem;
}
</style>