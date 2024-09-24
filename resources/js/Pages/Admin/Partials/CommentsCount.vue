<template>
    <div class="col-lg-6">
        <div class="p-5 shadow rounded-3 text-center">
            <i class="bi bi-chat-left-dots-fill text-danger me-1 icon"></i>
            <h1 class="mb-0"><strong>{{ comments }}</strong></h1>
            <p class="mt-0 h5">Written comments</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        comments: {
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