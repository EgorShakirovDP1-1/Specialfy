<template>
    <Layout>
        <div id="main-container" class="row justify-content-center text-start mx-auto my-4">
            <div class="col-12 col-sm-8 col-md-6">
                <form enctype="multipart/form-data" @submit.prevent="submitForm">
                    <h1 class="text-center">Add New Post</h1>

                    
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

                    <!-- Dynamic image inputs -->
             <input type="file" multiple @change="handleFileChange">
        
        <button type="submit">Submit</button></form>
           </div>
        </div>
    </Layout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from "../../Layout/App.vue";

const props = defineProps({
    errors: Object,
    categories: Array
});

const form = useForm({
  
    category_id: "",
    title: "",
    text: "",
    price: null,
    postImages: []
});

const handleFileChange = (event) => {
    form.postImages = Array.from(event.target.files); // Capture multiple files
};

const submitForm = () => {
    const formData = new FormData();
    
    // Append non-file fields
    Object.keys(form).forEach((key) => {
        if (key !== 'postImages') {
            formData.append(key, form[key]);
        }
    });

    // Append files as array
    form.postImages.forEach((picture) => {
        formData.append('postImages[]', picture);
    });

    // Submit with Inertia
    form.post(route('posts.create'), {
        forceFormData: true,
        onSuccess: () => {
            alert("Post created successfully!");
        },
    });
};
</script>
