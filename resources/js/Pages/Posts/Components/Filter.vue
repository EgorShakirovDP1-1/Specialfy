<!-- Filter.vue -->
<template>
    <div class="dropdown filter rounded mx-3 p-4 mb-2 background text-center" aria-labelledby="categoryDropdown">
        <h4 class="text-center text-black">Categories</h4>
        <button class="btn btn-light ms-1 border border-black dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Please select a category
        </button>
        <ul class="dropdown-menu border border-black select" id="categoryOptions" aria-labelledby="categoryDropdown">
            <li class="dropdown-item" @click="handleSetCategoryFilter('')" aria-label="Show all categories">
                All Categories
            </li>
            <li v-for="category in categories" 
                :key="category.id" 
                class="dropdown-item"
                @click="handleSetCategoryFilter(category.name)"
                :aria-label="'Filter by ' + category.name">
                {{ category.name }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['setCategoryFilter']);

const handleSetCategoryFilter = (value) => {
    emit('setCategoryFilter', value);
};
</script>

<style scoped>
.select {
    user-select: none;
    width: 84.5%;
}
</style>