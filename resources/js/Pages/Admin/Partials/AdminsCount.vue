<template>
    <div class="col-lg-6">
        <div class="p-5 rounded-3 text-center shadow">
            <i class="bi bi-person-fill-lock text-warning icon"></i>
            <h1 class="mb-0"><strong>{{ admins }}</strong></h1>
            <p class="mt-0 h5">Admins</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        admins: {
            type: Number,
            required: true,
        },
    },
};
</script>

<style scoped>
.icon {
    font-size: 4rem;
}
</style>