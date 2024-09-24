<template>
    <section class="p-lg-5" aria-labelledby="newArrivalsHeading">
        <div class="container text-center">
            <h1 class="mb-2" id="newArrivalsHeading">New Arrivals</h1>
            <div class="row justify-content-between flex-row-reverse">
                <div class="card col-12 col-md-5 col-lg-3 p-0 mb-3 bg-light m-1 .text-black border-primary"
                    v-for="film in films" :key="film.id">
                    <img :src="film.filmImage1" class="card-img-top img-fluid" alt="" />
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ film.filmname }} 
                        </h3>
                        <p class="text-white mb-0">
                            Price Per Subscribtion: {{ film.price_per_subscribtion }}€
                        </p>
                        <p class="text-white">
                            Price Per watch: {{ film.price_per_watch }}€
                        </p>
                        <div class="card-flex justify-content-center">
                            <Link :href="route('film.show', film.id)" class="btn btn-info mb-3 img-zoom text-primary">
                            <i class="bi bi-chevron-right"></i> Read More
                            </Link>
                            <button v-if="$page.props.auth" class="btn btn-light border-none ms-2 px-2 py-0 btn-48"
                                @click="toggleLike(film.id)">
                                <div class="card-flex align-items-center m-0" aria-label="Like Button">
                                    {{ film.likesCount }}
                                    <i class="bi h4 text-danger ms-1 mt-2"
                                        :class="{ 'bi-heart-fill': film.isLikedByUser, 'bi-heart': !film.isLikedByUser }"></i>
                                </div>
                            </button>
                            <Link v-if="!$page.props.auth" :href="route('login')">
                            <button class="btn btn-light border-none ms-2 px-2 py-2 btn-48" aria-label="Like Button">
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
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        films: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            isPressed: {}
        }
    },
    methods: {
        toggleLike(filmId) {
            this.$inertia.post(`/films/${filmId}/like`, {}, { preserveScroll: true })
        }
    }
};
</script>

<style scoped>
.btn-48 {
    height: 48px;
}
</style>
