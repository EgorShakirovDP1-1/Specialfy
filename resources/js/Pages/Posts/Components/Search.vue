<template>
    <div class="search-container">
        <input type="text" class="form-control" @input="search" placeholder="Search for post" aria-label="Search for post"
            aria-describedby="search-description">
        <span id="search-description" hidden>Type to search for posts</span>
    </div>
</template>

<script setup>
const emit = defineEmits(['search'])

const search = (e) => {
    emit('search', e.target.value)
}

</script>

<style scoped></style>
