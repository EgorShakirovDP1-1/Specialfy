<template>
    <Layout>
        <div id="main-container" class="row justify-content-center text-start mx-auto my-4">
            <div class="col-12 col-sm-8 col-md-6">
                <form enctype="multipart/form-data" @submit.prevent="handleSubmit">
                    <h1 class="text-center">Add New Film</h1>
                    <div class="form-group mt-3" aria-labelledby="authorLabel">
                        <label for="author" class="text-dark" id="authorLabel">Author</label><br>
                        <input v-model="form.author" type="text" name="author" id="author"
                            class="form-control border-primary" placeholder="Enter author">
                        <div v-if="errors.author" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.author }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="modelLabel">
                        <label for="model" class="text-dark" id="modelLabel">Model</label><br>
                        <input v-model="form.model" type="text" name="model" id="model"
                            class="form-control border-primary" placeholder="Enter model">
                        <div v-if="errors.model" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.model }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="yearLabel">
                        <label for="year" class="text-dark" id="yearLabel">Year</label><br>
                        <input v-model="form.year" type="number" name="year" id="year" class="form-control"
                            placeholder="Enter year">
                        <div v-if="errors.year" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.year }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="durationLabel">
                        <label for="duration" class="text-dark" id="durationLabel">Durations</label><br>
                        <input v-model="form.duration" type="number" name="duration" id="duration"
                            class="form-control" placeholder="Enter duration">
                        <div v-if="errors.duration" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.duration }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="genreTypeLabel">
                        <label for="filmname" class="text-dark" id="genreTypeLabel">Genre</label><br>
                        <input v-model="form.filmname" type="text" name="filmname" id="filmname"
                            class="form-control border-primary" placeholder="Enter name">
                        <div v-if="errors.filmname" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.filmname }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="genreTypeLabel">
                        <label for="genre" class="text-dark" id="genreTypeLabel">Name</label><br>
                        <input v-model="form.genre" type="text" name="genre" id="genre"
                            class="form-control border-primary" placeholder="Enter name">
                        <div v-if="errors.genre" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.genre }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="volumeLabel">
                        <label for="volume" class="text-dark" id="volumeLabel"> Volume</label><br>
                        <input v-model="form.volume" type="number" name="volume" id="volume"
                            class="form-control border-primary" placeholder="Enter volume">
                        <div v-if="errors.volume" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.volume }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="descriptionLabel">
                        <label for="description" class="text-dark" id="descriptionLabel">Description</label><br>
                        <input v-model="form.description" type="text" name="description" id="description"
                            class="form-control border-primary" placeholder="Enter description">
                        <div v-if="errors.description" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.description }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="pricePerSubscribtionLabel">
                        <label for="price_per_subscribtion" class="text-dark" id="pricePerSubscribtionLabel">Price per subscribtion</label><br>
                        <input v-model="form.price_per_subscribtion" type="number" name="price_per_subscribtion" id="price_per_subscribtion"
                            class="form-control border-primary" placeholder="Enter price per subscribtion">
                        <div v-if="errors.price_per_subscribtion" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.price_per_subscribtion }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group mt-3" aria-labelledby="pricePerwatchtchLabel">
                        <label for="price_per_watch" class="text-dark" id="pricePerwatchLabel">Price per watch</label><br>
                        <input v-model="form.price_per_watch" type="number" step="0.01" name="price_per_watch"
                            id="price_per_watch" class="form-control border-primary" placeholder="Enter price per watch">
                        <div v-if="errors.price_per_watch" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.price_per_watch }}
                            </span>
                        </div>
                    </div>
                    <div id="photoInputsContainer" aria-labelledby="filmImageLabel">
                        <div class="form-group mt-3">
                            <label for="filmImage1" class="text-dark" id="filmImageLabel">Add 1. film image</label><br>
                            <input @input="form.filmImage1 = $event.target.files[0]" type="file" name="filmImage1"
                                class="filmImage form-control border-primary" aria-describedby="filmImageError">
                            <div v-if="errors.filmImage1" class="d-block mt-2" id="filmImageError" role="alert">
                                <span class="fs-5 text-danger">
                                    {{ errors.filmImage1 }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" @click="addFileInput"
                            aria-label="Add Another Image Input">Add another Image</button>

                        <button type="submit" class="btn btn-info text-primary py-2 px-3"
                            aria-label="Submit Form">Save!</button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "../../Layout/App.vue";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    errors: Object,
});

const form = useForm({
    author: "",
    model: "",
    year: null,
    duration: null,
    filmname: "",
    genre: "",
    volume: null,
    description: "",
    price_per_subscribtion: null,
    price_per_watch: null,
    filmImage1: null,
    filmImage2: null,
    filmImage3: null,
    filmImage4: null,
    filmImage5: null,
    filmImage6: null,
    filmImage7: null,
    filmImage8: null,
});

const addFileInput = () => {
    // amounth of images
    const filmImageCount = document.querySelectorAll('.filmImage').length;

    // if there are already 8 images, don't add another one
    if (filmImageCount >= 8) {
        alert('You can only add up to 8 images.');
        return;
    }

    // get the next image number
    let nextImageNumber = filmImageCount + 1;

    // Create input element
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.name = `filmImage${nextImageNumber}`;
    fileInput.className = 'filmImage form-control border-primary';
    fileInput.addEventListener('input', (event) => {
        // Update the corresponding form variable with the selected file
        form[`filmImage${nextImageNumber}`] = event.target.files[0];
    });

    // Create label element
    const label = document.createElement('label');
    label.textContent = `Add ${nextImageNumber}. film image`;

    // Create div element and append label and input
    const div = document.createElement('div');
    div.className = 'form-group mt-3';
    div.appendChild(label);
    div.appendChild(fileInput);

    // Append the new input element to the photoInputsContainer
    const photoInputsContainer = document.getElementById('photoInputsContainer');
    photoInputsContainer.appendChild(div);
}

const handleSubmit = () => {
    form.post(route('films.create'), {
        filmImage1: form.filmImage1,
        filmImage2: form.filmImage2,
        filmImage3: form.filmImage3,
        filmImage4: form.filmImage4,
        filmImage5: form.filmImage5,
        filmImage6: form.filmImage6,
        filmImage7: form.filmImage7,
        filmImage8: form.filmImage8,
    });
}
</script>


<style scoped></style>
