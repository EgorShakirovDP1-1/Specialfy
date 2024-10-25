<template>
    <div class="col-lg-6">
        <div class="p-5 shadow rounded-3 text-center">
            <i class="bi bi-people-fill text-warning me-1 icon"></i>
            <h1 class="mb-0"><strong>{{ users }}</strong></h1>
            <p class="mt-0 h5">Users</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        users: {
            type: Number,
            required: true,
        },
    },
};
</script>

<style scoped>
.icon {
    -size: 4rem;
}
</style>