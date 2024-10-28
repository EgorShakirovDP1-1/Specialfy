<template>
    <button type="button" class="btn btn-info text-primary d-block py-2" style="width: 216px;" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop" aria-label="Liked Films Button">
        <i class="bi bi-heart-fill me-2"></i> Liked Films
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header justify-content-around">
                    <h5 class="modal-title" id="staticBackdropLabel">Liked films</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-around">
                        <div class="card col-12 col-md-5 col-lg-3 p-0 m-3 bg-light .text-black border-primary"
                            v-for="film in likedFilms" :key="film.id">
                            <img :src="film.filmImage1" class="card-img-top img-fluid" alt="" />
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ film.author }} {{ film.model }}
                                </h3>
                                <p class="text-white mb-0">
                                    Price Per Subscribtion: {{ film.price_per_subscribtion }}€
                                </p>
                                <p class="text-white">
                                    Price Per watch: {{ film.price_per_watch }}€
                                </p>
                                <!-- Button group -->
                                <div class="card-flex justify-content-center">
                                    <button @click="openFilmdetails(film.id)"
                                        class="btn btn-info mb-3 img-zoom text-primary"
                                        aria-label="Read More Button">
                                        <i class="bi bi-chevron-right"></i> Read More
                                    </button>
                                    <button v-if="$page.props.auth"
                                        class="btn btn-light border-none ms-2 px-2 py-0 btn-48"
                                        @click="toggleLike(film.id)"
                                        :aria-label="film.isLikedByUser ? 'Unlike Film Button' : 'Like Film Button'">
                                        <div class="card-flex align-items-center m-0">
                                            {{ film.likesCount }}
                                            <i class="bi h4 text-danger ms-1 mt-2"
                                                :class="{ 'bi-heart-fill': film.isLikedByUser, 'bi-heart': !film.isLikedByUser }"></i>
                                        </div>
                                    </button>
                                    <Link v-if="!$page.props.auth" :href="route('login')">
                                    <button class="btn btn-light border-none ms-2 px-2 py-2 btn-48"
                                        aria-label="Like Film Button">
                                        <div class="card-flex align-items-center m-0">
                                            {{ film.likesCount }}
                                            <i class="bi bi-heart h4 text-danger ms-1 mt-2"></i>
                                        </div>
                                    </button>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary p-0" data-bs-dismiss="modal"
                        aria-label="Close Modal Button">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        likedFilms: {
            type: Array,
            required: true,
        },
    },
    methods: {
        toggleLike(filmId) {
            this.$inertia.post(`/films/${filmId}/like`, {}, { preserveScroll: true });
        },
        openFilmdetails(filmId) {
            let modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            modal.hide();
            this.$inertia.visit(`/films/${filmId}`);
        }
    },
};
</script>

<style scoped>
.btn-48 {
    height: 48px;
}
</style>
