<template>
    <Layout>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <SideBar aria-label="sidebar navigation" />
                </div>
                <div class="overflow-auto col-md-9 mt-3">
                    <div class="d-flex justify-content-between" aria-label="posts list header">
                        <h3>Posts list</h3>
                        <Link :href="route('posts.create')" class="btn btn-info text-primary pb-2 rounded"
                            aria-label="add new post">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-camera2 h4 me-1"></i>
                            <p class="mb-1">
                                Add New Post
                            </p>
                        </div>
                        </Link>
                    </div>
                    <table class="table" aria-label="posts list table">
                        <thead>
                            <tr>
                                <th aria-label="number column">No.</th>
                                <th aria-label="author column">author</th>
                                <th aria-label="model column">model</th>
                                <th aria-label="year column">Year</th>
                                <th aria-label="duration column">HP</th>
                                <th aria-label="genrework column">Genrework</th>
                                <th aria-label="genre column">Genre</th>
                                <th class="text-end" aria-label="actions column">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="posts.data.length === 0">
                                <td colspan="8" aria-label="no posts found">No posts found.</td>
                            </tr>
                            <tr v-for="(post, index) in posts.data" :key="post.id">
                                <td aria-label="post number">{{ index + 1 }}.</td>
                                <td aria-label="post author">{{ post.author }}</td>
                                <td aria-label="post model">{{ post.model }}</td>
                                <td aria-label="post year">{{ post.year }}</td>
                                <td aria-label="post duration">{{ post.duration }}</td>
                                <td aria-label="post name">{{ post.postname }}</td>
                                <td aria-label="post name">{{ post.genre }}</td>
                                <td class="text-end" aria-label="post actions">
                                    <button class="btn btn-sm btn-warning me-1" aria-label="edit post">Edit</button>
                                    <Button @click="destroy(post.id)" class="btn btn-sm btn-danger"
                                        aria-label="delete post">Delete</Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="posts.links" class="d-flex justify-content-end"
                        aria-label="pagination for posts list" />
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import SideBar from "./Partials/SideBar.vue";
import Pagination from "./Partials/Pagination.vue";

export default {
    components: {
        Layout,
        Link,
        SideBar,
        Pagination,
    },
    props: {
        posts: {
            type: Object, //Array
            required: true,
        },
    },
    setup() {
        const destroy = (id) => {
            if (confirm("Are you sure?")) {
                router.delete(route("post.destroy", { post: id }));
            }
        };

        return { destroy };
    },
};

</script>

<style></style>