<template>
    <Layout>
        <form @submit.prevent="form.post(route('category.create'))" aria-label="category form">
            <label for="title">Create new Category</label>
            <input v-model="form.name" type="text" class="form-control" id="title" />
            <span v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</span>
            <button type="submit" :disabled="form.processing">Submit</button>
        </form>
        <div>
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories" :key="category.id">
                        <td>{{ category.name }}</td>
                        <td>
                            <button @click="deleteCategory(category.id)" class="btn btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { usePage, useForm, router } from '@inertiajs/vue3';

export default {
    components: {
        Layout,
    },
    setup() {
        // Initialize the form with Inertia's useForm
        const { props } = usePage();
        const categories = props.categories;
        const form = useForm({
            name: ""
        });
        const deleteCategory = (categoryId) => {
            if (confirm("Are you sure you want to delete this category?")) {
                 // Initialize form
                router.delete(route('categories.destroy', categoryId), {
                    preserveScroll: true, // optional, to maintain scroll position
                });
            }
        };  
        return {
            form,
            categories,
            deleteCategory,
        };
    }
};
</script>
