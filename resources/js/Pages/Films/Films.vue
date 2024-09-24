<template>
    <Layout>
        <div v-if="$page.props.isAdmin" id="create" class="text-center mb-0" role="region" aria-label="Admin Actions">
            <a :href="route('films.create')" class="btn btn-info text-primary pb-2 align-items-center">
                <div class="d-flex">
                    <i class="bi bi-camera-reels-fill h4 me-1"></i>
                    <p class="mb-0">
                        Add New film
                    </p>
                </div>
            </a>
        </div>

        <div class="box d-flex mx-auto my-3 justify-content-center" role="region" aria-label="Filter and Film Results">
            <div class="left">
                <Sort @sort="handleSort" />

                <Filter @setPricePerWatchFilter="handlePricePerWatchFilter" @setPriceFilter="handleSetPriceFilter"
                    @setDescriptionFilter="handleDescriptionFilter" @updateFuelTypeFilter="handleFuelTypeFilter"
                    @updateBodyTypeFilter="handleBodyTypeFilter" @updateAuthorFilter="handleAuthorFilter"
                    @setVolumeilter="updateVolumeilter" />
            </div>

            <div class="right w-75">
                <div class="w-100">
                    <Search @search="handleSearch" />
                </div>

                <section class="bg-black mt-2 rounded">
                    <div class="p-2">
                        <div class="container text-center">
                            <div class="row justify-content-between">
                                <div class="" v-if="filteredFilms.length === 0" role="status" aria-live="polite">
                                    This record doesn't exist
                                </div>
                                <div class="d col-lg-3 col-md-5 p-0 m-3 bg-light .text-black border-primary"
                                    v-for="film in filteredFilms" :key="film.id" role="listitem">
                                    <img :src="film.filmImageURL" class="d-img-top img-fluid" alt="Film Image" />
                                    <div class="d-body">
                                        <h3 class="d-title">
                                            {{ film.filmname }} 
                                        </h3>
                                        <p class="text-white mb-0">
                                            Price Per Subscribtion: {{ film.price_per_subscribtion }}€
                                        </p>
                                        <p class="text-white">
                                            Price Per Watch: {{ film.price_per_watch }}€
                                        </p>
                                        <div class="d-flex justify-content-center">
                                            <Link :href="route('film.show', film.id)"
                                                class="btn btn-info mb-3 img-zoom text-primary">
                                            <i class="bi bi-chevron-right"></i> Read More
                                            </Link>
                                            <button v-if="$page.props.auth"
                                                class="btn btn-light border-none ms-2 px-2 py-0 btn-48"
                                                @click="toggleLike(film.id)">
                                                <div class="d-flex align-items-center m-0">
                                                    {{ film.likesCount }}
                                                    <i class="bi h4 text-danger ms-1 mt-2"
                                                        :class="{ 'bi-heart-fill': film.isLikedByUser, 'bi-heart': !film.isLikedByUser }"
                                                        aria-label="Like"></i>
                                                </div>
                                            </button>
                                            <Link v-if="!$page.props.auth" :href="route('login')">
                                            <button class="btn btn-light border-none ms-2 px-2 py-2 btn-48"
                                                aria-label="Login to Like">
                                                <div class="d-flex align-items-center m-0">
                                                    {{ film.likesCount }}
                                                    <i class="bi bi-heart h4 text-danger ms-1 mt-2"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </button>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { Link } from "@inertiajs/vue3";
import Search from "./Components/Search.vue";
import Filter from "./Components/Filter.vue";
import Sort from "./Components/Sort.vue";

export default {
    components: {
        Layout,
        Link,
        Search,
        Filter,
        Sort,
    },
    props: {
        films: {
            type: Array,
            required: true
        },
        pagination: {
            type: String,
            required: true
        },
    },
    data() {
        return {
            isPressed: {},
            searchFilter: '',
            pricePerWatchFilter: '',
            pricePerSubscribtionFilter: '',
            descriptionFilter: [],
            fuelTypeFilters: [],
            volumeFilter: '',
            bodyTypeFilters: [],
            authorFilters: [],
            sortedFilms: [],
        }
    },
    methods: {
        toggleLike(filmId) {
            this.$inertia.post(`/films/${filmId}/like`, { filteredFilms: this.filteredFilms }, { preserveScroll: true })
        },
        handleSearch(search) {
            this.searchFilter = search;
        },
        handlePricePerWatchFilter(pricePerWatch) {
            this.pricePerWatchFilter = pricePerWatch;
        },
        handleSetPriceFilter(pricePerSubscribtion) {
            this.pricePerSubscribtionFilter = pricePerSubscribtion;
        },
        handleDescriptionFilter(description) {
            if (this.descriptionFilter.includes(description)) {
                this.descriptionFilter.splice(this.descriptionFilter.indexOf(description), 1);
            } else {
                this.descriptionFilter.push(description);
            }
        },
        handleFuelTypeFilter(fuelType) {
            if (this.fuelTypeFilters.includes(fuelType)) {
                this.fuelTypeFilters.splice(this.fuelTypeFilters.indexOf(fuelType), 1);
            } else {
                this.fuelTypeFilters.push(fuelType);
            }
        },
        updateVolumeilter(volume) {
            this.volumeFilter = volume;
        },
        handleBodyTypeFilter(bodyType) {
            if (this.bodyTypeFilters.includes(bodyType)) {
                this.bodyTypeFilters.splice(this.bodyTypeFilters.indexOf(bodyType), 1);
            } else {
                this.bodyTypeFilters.push(bodyType);
            }
        },
        handleAuthorFilter(author) {
            if (this.authorFilters.includes(author)) {
                this.authorFilters.splice(this.authorFilters.indexOf(author), 1);
            } else {
                this.authorFilters.push(author);
            }
        },
        handleSort(value) {
            if (value === 'cheapToExpensiveSubscribtion') {
                this.films.sort((a, b) => a.price_per_subscribtion - b.price_per_subscribtion);
            } else if (value === 'expensiveToCheapSubscribtion') {
                this.films.sort((a, b) => b.price_per_subscribtion - a.price_per_subscribtion);
            } else if (value === 'cheapToExpensiveWATCH') {
                this.films.sort((a, b) => a.price_per_watch - b.price_per_watch);
            } else if (value === 'expensiveToCheapWATCH') {
                this.films.sort((a, b) => b.price_per_watch - a.price_per_watch);
            } else if (value === 'mostPopular') {
                this.films.sort((a, b) => b.likesCount - a.likesCount);
            } else if (value === 'leastPopular') {
                this.films.sort((a, b) => a.likesCount - b.likesCount);
            }
        }
    },
    computed: {
        filteredFilms() {
            let films = this.films;

            if (this.pricePerWatchFilter !== '') {
                films = films.filter(film => film.price_per_watch <= this.pricePerWatchFilter);
            }

            if (this.pricePerSubscribtionFilter !== '') {
                films = films.filter(film => film.price_per_subscribtion <= this.pricePerSubscribtionFilter);
            }

            if (this.descriptionFilter.length > 0) {
                films = films.filter(film => this.descriptionFilter.includes(film.description));
            }

            if (this.fuelTypeFilters.length > 0) {
                films = films.filter(film => this.fuelTypeFilters.includes(film.genre));
            }

            if (this.volumeFilter !== '') {
                films = films.filter(film => film.volume <= this.volumeFilter);
            }

            if (this.bodyTypeFilters.length > 0) {
                films = films.filter(film => this.bodyTypeFilters.includes(film.filmname));
            }

            if (this.authorFilters.length > 0) {
                films = films.filter(film => this.authorFilters.includes(film.author));
            }

            if (this.sortedFilms.length > 0) {
                films = this.sortedFilms;
            }

            if (this.searchFilter !== '') {
                films = films.filter(film => film.author.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    film.model.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    film.filmname.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    film.genre.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    film.description.toLowerCase().includes(this.searchFilter.toLowerCase()));
            }

            return films;
        }
    }
}
</script>

<style scoped>
.logo {
    width: 100px;
}

#create {
    margin-top: 20px;
}

.btn-48 {
    height: 48px;
}
</style>
