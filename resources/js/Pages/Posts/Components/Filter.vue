<template>
        

        <div class="filter-box rounded p-4 mx-3 mb-2 background">
            <h4 class="text-center">Listing Type</h4>
            <div class="one-line">
                <label for="ZaglushkaNePridumalCheckbox">
                    <input type="checkbox" id="ZaglushkaNePridumalCheckbox" name="postnames[]" value="ZaglushkaNePridumal"
                        @change="updateBodyTypeFilter('ZaglushkaNePridumal')" aria-label="Filter by ZaglushkaNePridumal body type">
                    Users' posts
                </label>
            </div>
            <div class="one-line">
                <label for="ZaglushkaNePridumal2Checkbox">
                    <input type="checkbox" id="ZaglushkaNePridumal2Checkbox" name="postnames[]" value="ZaglushkaNePridumal2"
                        @change="updateBodyTypeFilter('ZaglushkaNePridumal2')" aria-label="Filter by ZaglushkaNePridumal2 body type">
                    Commercial posts
                </label>
            </div>
        </div>

      
       

   
    
       
        

      
      

   
        
    
</template>

<script setup>

const emit = defineEmits(['setPricePerWatchFilter', 'setPriceFilter', 'setDescriptionFilter', 'updateFuelTypeFilter',
    'updateBodyTypeFilter', 'updateAuthorFilter', 'setVolumeilter'])



const updateBodyTypeFilter = (value) => {
    emit('updateBodyTypeFilter', value)
}

const updateAuthorFilter = (value) => {
    emit('updateAuthorFilter', value)
}

</script>

<style scoped></style>
