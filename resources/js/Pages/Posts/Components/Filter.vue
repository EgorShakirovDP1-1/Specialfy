<template>
    <div class="filter rounded bg-black p-4 me-2">
        <div class="filter-box">
            <div class="d-flex align-items-center justify-content-between">
                <h4>Author</h4>
            </div>
            <div class="one-line">
                <label for="latvijaskinoCheckbox">
                    <input type="checkbox" id="latvijaskinoCheckbox" name="authors[]" value="LatvijasKino"
                        @change="updateAuthorFilter('LatvijasKino')" aria-label="Filter by LatvijasKino">
                    LatvijasKino
                </label>
            </div>
            <div class="one-line">
                <label for="bebraproductionCheckbox">
                    <input type="checkbox" id="bebraproductionCheckbox" name="authors[]" value="BEBRAPRODUCTION"
                        @change="updateAuthorFilter('BEBRAPRODUCTION')" aria-label="Filter by BEBRAPRODUCTION">
                    BEBRA PRODUCTION
                </label>
            </div>
            <div class="one-line">
                <label for="bangbrosCheckbox">
                    <input type="checkbox" id="bangbrosCheckbox" name="authors[]" value="Bangbros"
                        @change="updateAuthorFilter('Bangbros')" aria-label="Filter by Bangbros">
                    Bangbros
                </label>
            </div>
            <div class="one-line">
                <label for="unknownCheckbox">
                    <input type="checkbox" id="unknownCheckbox" name="authors[]" value="Unknown"
                        @change="updateAuthorFilter('Unknown')" aria-label="Filter by Unknown">
                    Documentary
                </label>
            </div>
            <div class="one-line">
                <label for="CRAPCheckbox">
                    <input type="checkbox" id="CRAPCheckbox" name="authors[]" value="CRAP"
                        @change="updateAuthorFilter('CRAP')" aria-label="Filter by CRAP">
                    Action
                </label>
            </div>
            <div class="one-line">
                <label for="jackiechanpostsCheckbox">
                    <input type="checkbox" id="jackiechanpostsCheckbox" name="authors[]" value="JackiechanPosts"
                        @change="updateAuthorFilter('JackiechanPosts')" aria-label="Filter by JackiechanPosts">
                    Adventure
                </label>
            </div>
            <div class="one-line">
                <label for="peugeotCheckbox">
                    <input type="checkbox" id="peugeotCheckbox" name="authors[]" value="Peugeot"
                        @change="updateAuthorFilter('Peugeot')" aria-label="Filter by Peugeot">
                    Animation
                </label>
            </div>
            <div class="one-line">
                <label for="twentycentuaryfoxCheckbox">
                    <input type="checkbox" id="twentycentuaryfoxCheckbox" name="authors[]" value="Twentycentuaryfox"
                        @change="updateAuthorFilter('Twentycentuaryfox')" aria-label="Filter by Twentycentuaryfox">
                    Anime
                </label>
            </div>
            <div class="one-line">
                <label for="realitykingsCheckbox">
                    <input type="checkbox" id="realitykingsCheckbox" name="authors[]" value=""
                        @change="updateAuthorFilter('RealityKings')" aria-label="Filter by RealityKings">
                    Drama
                </label>
            </div>
            <div class="one-line">
                <label for="vwCheckbox">
                    <input type="checkbox" id="vwCheckbox" name="authors[]" value="WarnerBrazzers"
                        @change="updateAuthorFilter('WarnerBrazzers')" aria-label="Filter by WarnerBrazzers">
                    Fantasy
                </label>
            </div>
            <hr>
        </div>

        <div class="filter-box">
            <h4>Post Type</h4>
            <div class="one-line">
                <label for="ZaglushkaNePridumalCheckbox">
                    <input type="checkbox" id="ZaglushkaNePridumalCheckbox" name="postnames[]" value="ZaglushkaNePridumal"
                        @change="updateBodyTypeFilter('ZaglushkaNePridumal')" aria-label="Filter by ZaglushkaNePridumal body type">
                    Users posts
                </label>
            </div>
            <div class="one-line">
                <label for="ZaglushkaNePridumal2Checkbox">
                    <input type="checkbox" id="ZaglushkaNePridumal2Checkbox" name="postnames[]" value="ZaglushkaNePridumal2"
                        @change="updateBodyTypeFilter('ZaglushkaNePridumal2')" aria-label="Filter by ZaglushkaNePridumal2 body type">
                    Comercial posts
                </label>
            </div>
            
            
          
            <hr>
        </div>

      
       

   
    
       
        

      
      

   
        
    </div>
</template>

<script setup>

const emit = defineEmits(['setPricePerWatchFilter', 'setPriceFilter', 'setDescriptionFilter', 'updateFuelTypeFilter',
    'updateBodyTypeFilter', 'updateAuthorFilter', 'setVolumeilter'])

const setPricePerWatchFilter = (value) => {
    emit('setPricePerWatchFilter', value)
}

const setPriceFilter = (value) => {
    emit('setPriceFilter', value)
}

const setDescriptionFilter = (value) => {
    emit('setDescriptionFilter', value)
}

const updateFuelTypeFilter = (value) => {
    emit('updateFuelTypeFilter', value)
}

const setVolumeilter = (value) => {
    emit('setVolumeilter', value)
}

const updateBodyTypeFilter = (value) => {
    emit('updateBodyTypeFilter', value)
}

const updateAuthorFilter = (value) => {
    emit('updateAuthorFilter', value)
}

</script>

<style scoped></style>
