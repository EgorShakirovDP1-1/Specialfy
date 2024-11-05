<template>
    <Layout>
        <div id="main-container" class="row justify-content-center text-start mx-auto my-4">
            <div class="col-12 col-sm-8 col-md-6">
                <form enctype="multipart/form-data" @submit.prevent="submitForm">
                    <h1 class="text-center">Add New Post</h1>

                    <div class="form-group mb-3">
                        <label for="author">Author</label>
                        <input v-model="form.author" type="text" class="form-control" id="author" />
                        <span v-if="errors.author" class="text-danger">{{ errors.author }}</span>
                    </div>
                    <div class="form-group mb-3">
    <label for="category">Category</label>
    <select v-model="form.category_id" class="form-control" id="category">
        <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
        </option>
    </select>
    <span v-if="errors.category_id" class="text-danger">{{ errors.category_id }}</span>
</div>


                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input v-model="form.price" type="number" class="form-control" id="price" />
                        <span v-if="errors.price" class="text-danger">{{ errors.price }}</span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input v-model="form.title" type="text" class="form-control" id="title" />
                        <span v-if="errors.title" class="text-danger">{{ errors.title }}</span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="text">Text</label>
                        <textarea v-model="form.text" class="form-control" id="text"></textarea>
                        <span v-if="errors.text" class="text-danger">{{ errors.text }}</span>
                    </div>

                    <div id="photoInputsContainer" class="form-group mb-3">
                        <button type="button" class="btn btn-outline-primary" @click="addFileInput">Add Image</button>
                        <div v-for="(picture, index) in form.postImages" :key="index" class="mt-2">
                            <label :for="'postImage' + (index + 1)">Post Image {{ index + 1 }}</label>
                            <input type="file" class="form-control postImage" :name="'postImage' + (index + 1)" @change="handleFileChange($event, index)" />
                        </div>
                        <span v-if="errors.postImages" class="text-danger">{{ errors.postImages }}</span>
                    </div>

                    <button type="submit" class="btn btn-dark text-white text-primary py-2 px-3" aria-label="Submit Form">Save!</button>
                </form>
           </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "../../Layout/App.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { onMounted } from "vue";


const props = defineProps({
    errors: Object,
    categories: Array
});

const form = useForm({
    author: "",
    category_id: "",
    title: "",
    text: "",
    price: null,
    postImages: []
});

const addFileInput = () => {
    if (form.postImages.length >= 8) {
        alert('You can only add up to 8 images.');
        return;
    }
    form.postImages.push(null);
};

const handleFileChange = (event, index) => {
    form.postImages[index] = event.target.files[0];
};

const submitForm = () => {
    const formData = new FormData();

    // Append all form fields except images
    Object.keys(form).forEach((key) => {
        if (key !== 'postImages') {
            formData.append(key, form[key]);
        }
    });

    // Append all images
    form.postImages.forEach((picture, index) => {
        if (picture) {
            formData.append(`postImage${index + 1}`, picture);
        }
    });

    // Use Inertia to post the form data
    form.post(route('posts.create'), {
        forceFormData: true,
        onSuccess: () => {
            alert("Post created successfully!");
        },
    });
};
</script>
