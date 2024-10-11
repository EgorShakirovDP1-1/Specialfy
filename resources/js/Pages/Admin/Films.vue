<template>
    <Layout>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <SideBar aria-label="sidebar navigation" />
                </div>
                <div class="overflow-auto col-md-9 mt-3">
                    <div class="d-flex justify-content-between" aria-label="films list header">
                        <h3>Films list</h3>
                        <Link :href="route('films.create')" class="btn btn-info text-primary pb-2 rounded"
                            aria-label="add new film">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="bi bi-camera2 h4 me-1"></i>
                            <p class="mb-1">
                                Add New Film
                            </p>
                        </div>
                        </Link>
                    </div>
                    <table class="table" aria-label="films list table">
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
                            <tr v-if="films.data.length === 0">
                                <td colspan="8" aria-label="no films found">No films found.</td>
                            </tr>
                            <tr v-for="(film, index) in films.data" :key="film.id">
                                <td aria-label="film number">{{ index + 1 }}.</td>
                                <td aria-label="film author">{{ film.author }}</td>
                                <td aria-label="film model">{{ film.model }}</td>
                                <td aria-label="film year">{{ film.year }}</td>
                                <td aria-label="film duration">{{ film.duration }}</td>
                                <td aria-label="film name">{{ film.filmname }}</td>
                                <td aria-label="film name">{{ film.genre }}</td>
                                <td class="text-end" aria-label="film actions">
                                    <button class="btn btn-sm btn-warning me-1" aria-label="edit film">Edit</button>
                                    <Button @click="destroy(film.id)" class="btn btn-sm btn-danger"
                                        aria-label="delete film">Delete</Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="films.links" class="d-flex justify-content-end"
                        aria-label="pagination for films list" />
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
        films: {
            type: Object, //Array
            required: true,
        },
    },
    setup() {
        const destroy = (id) => {
            if (confirm("Are you sure?")) {
                router.delete(route("film.destroy", { film: id }));
            }
        };

        return { destroy };
    },
};

</script>

<style></style>