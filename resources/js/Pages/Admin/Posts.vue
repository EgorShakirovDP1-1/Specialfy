<template>
    <Layout>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 my-3 mx-2 rounded background">
                    <SideBar aria-label="sidebar navigation" />
                </div>
                <div class="overflow-auto col-md-9 my-3 mx-2 rounded background">
                    <div class="d-flex justify-content-between mt-3 mx-2 background" aria-label="posts list header">
                        <h3>Posts list</h3>
                        <input
                            type="text"
                            v-model="searchFilter"
                            class="form-control w-25"
                            placeholder="Search posts"
                            aria-label="Search posts"
                        />
                        <Link :href="route('posts.create')" class="btn btn-dark pb-2 rounded"
                            aria-label="add new post">
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="mb-1">
                                    Add New Post
                                </p>
                            </div>
                        </Link>
                    </div>
                    <table class="table mt-2" aria-label="posts list table">
                        <thead>
                            <tr>
                                <th aria-label="number column">No.</th>
                                <th aria-label="author column">Author</th>
                                <th aria-label="category column">Category</th>
                                <th aria-label="title column">Title</th>
                                <th class="text-end" aria-label="actions column">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="filteredPosts.length === 0">
                                <td colspan="8" aria-label="no posts found">No posts found.</td>
                            </tr>
                            <tr v-for="(post, index) in filteredPosts" :key="post.id">
                                <td aria-label="post number">{{ index + 1 }}.</td>
                                <td aria-label="post author">{{ post.user.name }}</td>
                                <td aria-label="post category">{{ post.category.name }}</td>
                                <td aria-label="post title">{{ post.title }}</td>
                                <td class="text-end" aria-label="post actions">
                                    <button class="btn btn-sm btn-dark me-2 m-1 fixed-width" aria-label="edit post">Edit</button>
                                    <button @click="destroy(post.id)" class="btn btn-sm btn-danger me-2 fixed-width" aria-label="delete post">Delete</button>
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
            type: Object, // The posts object contains the paginated posts and relationships
            required: true,
        },
    },
    data() {
        return {
            searchFilter: '', // Holds the search query
        };
    },
    setup() {
        const destroy = (id) => {
            if (confirm("Are you sure?")) {
                router.delete(route("post.destroy", id ));
            }
        };

        return { destroy };
    },
    computed: {
        filteredPosts() {
            let posts = this.posts.data;

            if (this.searchFilter) {
                const searchQuery = this.searchFilter.toLowerCase();

                posts = posts.filter(post => {
                    return (
                        (post.user && post.user.name && post.user.name.toLowerCase().includes(searchQuery)) ||
                        (post.category && post.category.name && post.category.name.toLowerCase().includes(searchQuery)) ||
                        (post.title && post.title.toLowerCase().includes(searchQuery))
                    );
                });
            }

            return posts;
        }
    }
};
</script>


<style>
.background{
    background-color: rgb(230,230,230)

}
.fixed-width {
        width: 80px; /* Adjust this value as needed */
    }

</style>