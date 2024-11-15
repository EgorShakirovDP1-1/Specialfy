<template>
    <div class="dropdown filter rounded p-4 mx-3 mb-2 background" aria-labelledby="sortingDropdown">
        <h4 class="text-center text-black">Sorting</h4>
        <button class="btn btn-light border border-black  dropdown-toggle" type="button" id="sortingDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Please select an option
        </button>
        <ul class="dropdown-menu border border-black select" id="sortingOptions" aria-labelledby="sortingDropdown">
            <li class="dropdown-item" @click="sort('cheapToExpensiveSubscribtion')" aria-label="Sort from cheapest to most expensive per subscribtion">Price ascending</li>
            <li class="dropdown-item" @click="sort('expensiveToCheapSubscribtion')" aria-label="Sort from most expensive to cheapest per subscribtion">Price descending</li>
            <li class="dropdown-item" @click="sort('mostPopular')" aria-label="Sort by most popular">Top rated descending</li>
            <li class="dropdown-item" @click="sort('leastPopular')" aria-label="Sort by least popular">Top rated ascending</li>
        </ul>
    </div>
</template>

<script setup>
const emit = defineEmits(['sort']);

const sort = (value) => {
    emit('sort', value)
}
</script>

<style scoped>
    .select {
        user-select:none;
    }
</style>
