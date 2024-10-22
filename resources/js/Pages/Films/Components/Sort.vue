<template>
    <div class="dropdown filter rounded bg-black p-4 me-2" aria-labelledby="sortingDropdown">
        <h4 class="text-center">Sorting</h4>
        <button class="btn btn-secondary dropdown-toggle" type="button" id="sortingDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Please select an option
        </button>
        <ul class="dropdown-menu" id="sortingOptions" aria-labelledby="sortingDropdown">
            <li class="dropdown-item" @click="sort('cheapToExpensiveSubscribtion')" aria-label="Sort from cheapest to most expensive per subscribtion">From cheapest to most expensive (subscribtion)</li>
            <li class="dropdown-item" @click="sort('expensiveToCheapSubscribtion')" aria-label="Sort from most expensive to cheapest per subscribtion">From most expensive to cheapest (subscribtion)</li>
            <li class="dropdown-item" @click="sort('cheapToExpensivewatch')" aria-label="Sort from cheapest to most expensive per watch">From cheapest to most expensive (watch)</li>
            <li class="dropdown-item" @click="sort('expensiveToCheapwatch')" aria-label="Sort from most expensive to cheapest per watch">From most expensive to cheapest (watch)</li>
            <li class="dropdown-item" @click="sort('mostPopular')" aria-label="Sort by most popular">Most popular</li>
            <li class="dropdown-item" @click="sort('leastPopular')" aria-label="Sort by least popular">Least popular</li>
        </ul>
    </div>
</template>

<script setup>
const emit = defineEmits(['sort']);

const sort = (value) => {
    emit('sort', value)
}
</script>

<style scoped></style>
