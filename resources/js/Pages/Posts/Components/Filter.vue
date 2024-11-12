<template>
    <div class="filter-box rounded p-4 mx-3 mb-2 background">
        <h4 class="text-center">Categories</h4>
        <select @change="handleSetCategoryFilter($event.target.value)" class="form-select">
            <option value="">All Categories</option>
            <option v-for="category in categories" :key="category.id" :value="category.name">
                {{ category.name }}
            </option>
        </select>
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

const handleSetCategoryFilter = (categoryName) => {
    emit('setCategoryFilter', categoryName);
};
</script>

<style scoped>
.filter-box {
    background-color: rgb(230, 230, 230);
}

.form-select {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ced4da;
    font-size: 1rem;
}
</style>