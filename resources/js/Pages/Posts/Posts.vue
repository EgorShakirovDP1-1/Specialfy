<template>
    <Layout>
        <div v-if="$page.props.isAdmin" id="create" class="text-center mb-0" role="region" aria-label="Admin Actions">
            <a :href="route('posts.create')" class="btn btn-info text-primary pb-2 align-items-center">
                <div class="d-flex">
                    <i class="bi bi-camera-reels-fill h4 me-1"></i>
                    <p class="mb-0">
                        Add New post
                    </p>
                </div>
            </a>
        </div>

        <div class="box d-flex mx-auto my-3 justify-content-center" role="region" aria-label="Filter and Post Results">
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
                                <div class="" v-if="filteredPosts.length === 0" role="status" aria-live="polite">
                                    This record doesn't exist
                                </div>
                                <div class="d col-lg-3 col-md-5 p-0 m-3 bg-light .text-black border-primary"
                                    v-for="post in filteredPosts" :key="post.id" role="listitem">
                                    <img :src="post.postImageURL" class="d-img-top img-fluid" alt="Post Image" />
                                    <div class="d-body">
                                        <h3 class="d-title">
                                            {{ post.postname }} 
                                        </h3>
                                        <p class="text-black mb-0">
                                            Price Per Subscribtion: {{ post.price_per_subscribtion }}€
                                        </p>
                                        <p class="text-black">
                                            Price Per Watch: {{ post.price_per_watch }}€
                                        </p>
                                        <div class="d-flex justify-content-center">
                                            <Link :href="route('post.show', post.id)"
                                                class="btn btn-info mb-3 img-zoom text-primary">
                                            <i class="bi bi-chevron-right"></i> Read More
                                            </Link>
                                            <button v-if="$page.props.auth"
                                                class="btn btn-light border-none ms-2 px-2 py-0 btn-48"
                                                @click="toggleLike(post.id)">
                                                <div class="d-flex align-items-center m-0">
                                                    {{ post.rating }}
                                                    <i class="bi h4 text-danger ms-1 mt-2"
                                                        :class="{ 'bi-heart-fill': post.isLikedByUser, 'bi-heart': !post.isLikedByUser }"
                                                        aria-label="Like"></i>
                                                </div>
                                            </button>
                                            <Link v-if="!$page.props.auth" :href="route('login')">
                                            <button class="btn btn-light border-none ms-2 px-2 py-2 btn-48"
                                                aria-label="Login to Like">
                                                <div class="d-flex align-items-center m-0">
                                                    {{ post.rating }}
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
        posts: {
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
            sortedPosts: [],
        }
    },
    methods: {
        toggleLike(postId) {
            this.$inertia.post(`/posts/${postId}/like`, { filteredPosts: this.filteredPosts }, { preserveScroll: true })
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
                this.posts.sort((a, b) => a.price_per_subscribtion - b.price_per_subscribtion);
            } else if (value === 'expensiveToCheapSubscribtion') {
                this.posts.sort((a, b) => b.price_per_subscribtion - a.price_per_subscribtion);
            } else if (value === 'cheapToExpensiveWATCH') {
                this.posts.sort((a, b) => a.price_per_watch - b.price_per_watch);
            } else if (value === 'expensiveToCheapWATCH') {
                this.posts.sort((a, b) => b.price_per_watch - a.price_per_watch);
            } else if (value === 'mostPopular') {
                this.posts.sort((a, b) => b.likesCount - a.likesCount);
            } else if (value === 'leastPopular') {
                this.posts.sort((a, b) => a.likesCount - b.likesCount);
            }
        }
    },
    computed: {
        filteredPosts() {
            let posts = this.posts;

            if (this.pricePerWatchFilter !== '') {
                posts = posts.filter(post => post.price_per_watch <= this.pricePerWatchFilter);
            }

            if (this.pricePerSubscribtionFilter !== '') {
                posts = posts.filter(post => post.price_per_subscribtion <= this.pricePerSubscribtionFilter);
            }

            if (this.descriptionFilter.length > 0) {
                posts = posts.filter(post => this.descriptionFilter.includes(post.description));
            }

            if (this.fuelTypeFilters.length > 0) {
                posts = posts.filter(post => this.fuelTypeFilters.includes(post.genre));
            }

            if (this.volumeFilter !== '') {
                posts = posts.filter(post => post.volume <= this.volumeFilter);
            }

            if (this.bodyTypeFilters.length > 0) {
                posts = posts.filter(post => this.bodyTypeFilters.includes(post.postname));
            }

            if (this.authorFilters.length > 0) {
                posts = posts.filter(post => this.authorFilters.includes(post.author));
            }

            if (this.sortedPosts.length > 0) {
                posts = this.sortedPosts;
            }

            if (this.searchFilter !== '') {
                posts = posts.filter(post => post.author.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    post.model.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    post.postname.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    post.genre.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                    post.description.toLowerCase().includes(this.searchFilter.toLowerCase()));
            }

            return posts;
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