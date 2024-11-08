<template>
    <div class="search-container me-2">
        <input type="text" class="rounded form-control " @input="search" placeholder="Search for listings" aria-label="Search for post"
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
    background-color: rgb(230, 230, 230);
    color: black;
}
 .form-control::placeholder{

    color: rgb(40,40,40);
 }


</style>
