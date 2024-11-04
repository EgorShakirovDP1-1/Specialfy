<template>
        

     
        <div class="filter-box rounded p-4 mx-3 mb-2 background">
    <h4 class="text-center">Categories</h4>
    <select @change="handleSetCategoryFilter($event.target.value)" class="form-select">
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
        </option>
    </select>
</div>

</template>

<script setup>






</script>

<style scoped></style>
