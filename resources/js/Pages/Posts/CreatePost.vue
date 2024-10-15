<template>
    <Layout>
        <div id="main-container" class="row justify-content-center text-start mx-auto my-4">
            <div class="col-12 col-sm-8 col-md-6">
                <form enctype="multipart/form-data" @submit.prevent="handleSubmit">
                    <h1 class="text-center">Add New Post</h1>
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
                        <label for="postname" class="text-dark" id="genreTypeLabel">Genre</label><br>
                        <input v-model="form.postname" type="text" name="postname" id="postname"
                            class="form-control border-primary" placeholder="Enter name">
                        <div v-if="errors.postname" class="d-block mt-2" role="alert">
                            <span class="fs-5 text-danger">
                                {{ errors.postname }}
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
                    <div id="photoInputsContainer" aria-labelledby="postImageLabel">
                        <div class="form-group mt-3">
                            <label for="postImage1" class="text-dark" id="postImageLabel">Add 1. post image</label><br>
                            <input @change="handleFileChange($event, 'postImage1')" type="file" name="postImage1"
                                class="postImage form-control border-primary" aria-describedby="postImageError">
                            <div v-if="errors.postImage1" class="d-block mt-2" id="postImageError" role="alert">
                                <span class="fs-5 text-danger">
                                    {{ errors.postImage1 }}
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
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    errors: Object,
});

const form = useForm({
    author: "",
    model: "",
    year: null,
    duration: null,
    postname: "",
    genre: "",
    volume: null,
    description: "",
    price_per_subscribtion: null,
    price_per_watch: null,
    postImages: {}
});

const addFileInput = () => {
    const postImageCount = document.querySelectorAll('.postImage').length;

    if (postImageCount >= 8) {
        alert('You can only add up to 8 images.');
        return;
    }

    let nextImageNumber = postImageCount + 1;
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.name = `postImage${nextImageNumber}`;
    fileInput.className = 'postImage form-control border-primary';
    fileInput.addEventListener('change', (event) => {
        handleFileChange(event, `postImage${nextImageNumber}`);
    });

    const label = document.createElement('label');
    label.textContent = `Add ${nextImageNumber}. post image`;

    const div = document.createElement('div');
    div.className = 'form-group mt-3';
    div.appendChild(label);
    div.appendChild(fileInput);

    document.getElementById('photoInputsContainer').appendChild(div);
};

const handleFileChange = (event, key) => {
    form.postImages[key] = event.target.files[0];
};

const handleSubmit = () => {
    const formData = new FormData();

    // Append form fields
    Object.keys(form).forEach((key) => {
        if (key !== 'postImages') {
            formData.append(key, form[key]);
        }
    });

    // Append file inputs
    Object.keys(form.postImages).forEach((key) => {
        formData.append(key, form.postImages[key]);
    });

    // Submit using Inertia's `post` method with FormData
    form.post(route('posts.create'), {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
        data: formData,
        onSuccess: () => {
            alert("Post uploaded successfully!");
        }
    });
};
</script>

<style scoped></style>
