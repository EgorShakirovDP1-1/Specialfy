<template>
    <div class="col-lg-6">
        <div class="p-5 shadow rounded-3 text-center">
            <i class="bi bi-bank text-success me-1 icon"></i>
            <h1 class="mb-0"><strong>{{ moneyDividedBy100 }}k €</strong></h1>
            <p class="mt-0 h5">Money earned</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        money: {
            type: Number,
            required: true,
        },
    },
    computed: {
        moneyDividedBy100() {
            return this.money / 100;
        }
    }
};
</script>

<style scoped>
.icon {
    font-size: 4rem;
}
</style>