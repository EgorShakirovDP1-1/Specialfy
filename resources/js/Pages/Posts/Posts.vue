<template>
    <Layout>
        <div id="create" class="text-center my-4" role="region" aria-label="Admin Actions">
            <a :href="route('posts.create')" class="btn btn-dark py-3 px-5 align-items-center">
                <div class="d-flex">
                    <p class="mb-0">
                        Create a listing
                    </p>
                </div>
            </a>
        </div>

        <div class="box d-flex mx-auto my-3 justify-content-center" role="region" aria-label="Filter and Post Results">
            <div class="left">
                <Sort @sort="handleSort" />

                <Filter :categories="categories" @setCategoryFilter="handleSetCategoryFilter" />
            </div>

            <div class="right w-75">
                <div class="w-100">
                    <Search @search="handleSearch" />
                </div>
                <section class=" mt-2 rounded background me-2">
                    <div class="p-2">
                        <div class="container text-center">
                            <div class="row justify-content-evenly">
                                <div class="" v-if="filteredPosts.length === 0" role="status" aria-live="polite">
                                    This record doesn't exist
                                </div>
                                <!-- LISTING CARDS -->
                                <div class="d col-lg-3 col-md-5 py-4 px-3 m-3 bg-light text-black border-primary rounded d-flex flex-column"
                                    v-for="post in filteredPosts" :key="post.id" role="listitem">
                                    <img :src="getImageUrl(post.postImage)" class="d-img-top img-fluid rounded mb-3" alt="Post Image" />
                                    <div class="d-body flex-grow-1">
                                        <h4 class="d-title">
                                             {{ post.title }}
                                        </h4>
                                        <div class="post-images">
                                            <div v-for="image in images" :key="image.id" class="post-image">
                                                <img :src="getImageUrl(image.path_to_img)" alt="Listing Image"/>
                                            </div>
                                        </div>
                                        <p class="text-black mb-0">
                                            {{ post.category_name }}
                                        </p>
                                        <p class="text-black">
                                            Price: {{ post.price }}€
                                        </p>
                                    </div>

                                    <!-- Bottom-aligned section -->
                                    <div class="d-flex justify-content-center align-items-center m-2">
                                        <Link :href="route('post.show', post.id)" class="btn bg-danger img-zoom text-white">
                                            <i class="bi bi-chevron-right"></i> Read More
                                        </Link>
                                        
                                        <button v-if="$page.props.auth" class="btn btn-light border-none ms-2 px-2 py-0 btn-48">
                                            <div class="d-flex align-items-center m-0">
                                                {{ post.rating }}
                                                <i class="bi h4 ms-1 mt-1 bi-star-fill"
                                                    :class="[
                                                        post.rating > 0 ? 'text-success' :
                                                        post.rating < 0 ? 'text-danger' :
                                                        'text-secondary'
                                                    ]"
                                                    aria-label="Rating"></i>
                                            </div>
                                        </button>

                                        <Link v-if="!$page.props.auth" :href="route('login')">
                                            <button class="btn btn-light border-none ms-2 px-2 py-2 btn-48 pe-none" aria-label="Login to Like">
                                                <div class="d-flex align-items-center m-0">
                                                    {{ post.rating }}
                                                    <i class="bi bi-star-fill h4 text-danger ms-1 mt-1" aria-hidden="true"></i>
                                                </div>
                                            </button>
                                        </Link>
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
        images: {
            type: Array,
            required: true
        },
        categories: { // Receive categories as a prop
            type: Array,
            required: true
        },
    },
    data() {
        return {
            isPressed: {},
            authorFilters: [],
            
            pricePerWatchFilter: '',
            pricePerSubscribtionFilter: '',
            selectedCategory: null, // Holds the selected category ID
            searchFilter: '',
            
           
           
            sortedPosts: [],
        }
    },
    methods: {
        getImageUrl(path) {
            return `/storage/${path}`;
        },
        toggleLike(postId) {
            this.$inertia.post(`/posts/${postId}/like`, { filteredPosts: this.filteredPosts }, { preserveScroll: true })
        },
        handleSearch(search) {
            this.searchFilter = search;
        },
        handleRatingFilter(rating) {
            this.RatingFilter = rating;
        },
        handleSetPriceFilter(price) {
            this.priceFilter = price;
        },
        handleSetCategoryFilter(categoryId) {
            this.selectedCategory = categoryId; // Update the selected category
        },

       
       
       
        
        handleSort(value) {
            if (value === 'cheapToExpensiveSubscribtion') {
                this.posts.sort((a, b) => a.price - b.price);
            } else if (value === 'expensiveToCheapSubscribtion') {
                this.posts.sort((a, b) => b.price - a.price);
            } 
            if (value === 'mostPopular') {
                this.posts.sort((a, b) => a.rating - b.rating);
            }
            else if (value === 'leastPopular') {
                this.posts.sort((a, b) => b.rating - a.rating);
            }
        }
    },
    computed: {
    filteredPosts() {
        let posts = this.posts;

        // Apply price filter if set
        if (this.pricePerSubscribtionFilter !== '') {
            posts = posts.filter(post => post.price_per_subscribtion <= this.pricePerSubscribtionFilter);
        }
        if (this.selectedCategory) {
                posts = posts.filter(post => post.category_name === this.selectedCategory);
            }
        // Apply search filter if set
        if (this.searchFilter !== '') {
            const searchQuery = this.searchFilter.toLowerCase();

            posts = posts.filter(post => {
                // Safely check if each property exists and matches the search query
                return (
                   
                    (post.title && post.title.toLowerCase().includes(searchQuery)) ||
                   
                    (post.text && post.text.toLowerCase().includes(searchQuery))
                );
                
            });
        }

        // Apply sorting if any sorted posts are available
        if (this.sortedPosts.length > 0) {
            posts = this.sortedPosts;
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

.background{
    background-color: rgb(230,230,230)

}

.d-title{
    letter-spacing: normal;
}
</style>