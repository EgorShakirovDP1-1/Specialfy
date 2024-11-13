<template>
    <div class="col-lg-6">
        <div class="panel p-4 rounded-3 text-center shadow">
            <i class="bi bi-chat-left-dots-fill text-danger icon"></i>
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