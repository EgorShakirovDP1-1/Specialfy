<template>
    <section class="p-lg-5" aria-labelledby="newArrivalsHeading">
        <div class="container text-center">
            <h1 class="mb-2" id="newArrivalsHeading">New Arrivals</h1>
            <div class="row justify-content-between flex-row-reverse">
                <div class="card col-12 col-md-5 col-lg-3 p-0 mb-3 bg-light m-1 .text-black border-primary"
                    v-for="post in posts" :key="post.id">
                    <img :src="post.postImage1" class="card-img-top img-fluid" alt="" />
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ post.postname }} 
                        </h3>
                        <p class="text-black mb-0">
                            Price Per Subscribtion: {{ post.price_per_subscribtion }}€
                        </p>
                        <p class="text-black">
                            Price Per watch: {{ post.price_per_watch }}€
                        </p>
                        <div class="card-flex justify-content-center">
                            <Link :href="route('post.show', post.id)" class="btn btn-info mb-3 img-zoom text-primary">
                            <i class="bi bi-chevron-right"></i> Read More
                            </Link>
                            <button v-if="$page.props.auth" class="btn btn-light border-none ms-2 px-2 py-0 btn-48"
                                @click="toggleLike(post.id)">
                                <div class="card-flex align-items-center m-0" aria-label="Like Button">
                                    {{ post.likesCount }}
                                    <i class="bi h4 text-danger ms-1 mt-2"
                                        :class="{ 'bi-heart-fill': post.isLikedByUser, 'bi-heart': !post.isLikedByUser }"></i>
                                </div>
                            </button>
                            <Link v-if="!$page.props.auth" :href="route('login')">
                            <button class="btn btn-light border-none ms-2 px-2 py-2 btn-48" aria-label="Like Button">
                                <div class="card-flex align-items-center m-0">
                                    {{ post.likesCount }}
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
        posts: {
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
        toggleLike(postId) {
            this.$inertia.post(`/posts/${postId}/like`, {}, { preserveScroll: true })
        }
    }
};
</script>

<style scoped>
.btn-48 {
    height: 48px;
}
</style>
