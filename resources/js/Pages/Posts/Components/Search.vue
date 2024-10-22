<template>
    <div class="search-container">
        <input type="text" class="rounded form-control " @input="search" placeholder="Search for post" aria-label="Search for post"
            aria-describedby="search-description">
    </div>
</template>

<script setup>
const emit = defineEmits(['search'])

const search = (e) => {
    emit('search', e.target.value)
}

</script>



<style scoped>
.form-control {

    /* border-radius: 10px; */
    background-color: rgb(255, 220, 220);
    color: black;
}
 .form-control::placeholder{

    color: rgb(32, 32, 32);
 }


</style>
