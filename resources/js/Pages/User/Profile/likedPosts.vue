<template>
    <button type="button" class="btn btn-dark d-block py-2" style="width: 216px;" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop" aria-label="Liked Posts Button">
        <i class="bi bi-heart-fill me-2"></i> Liked Posts
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header justify-content-around">
                    <h5 class="modal-title" id="staticBackdropLabel">Liked posts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-around">
                        <div class="card col-12 col-md-5 col-lg-3 p-0 m-3 bg-light .text-black border-primary"
                            v-for="post in likedPosts" :key="post.id">
                            <img :src="getImageUrl(post.postImage1)" class="d-img-top img-fluid rounded mb-3" alt="Post Image" />
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ post.author }} {{ post.model }}
                                </h3>
                                <p class="text-black mb-0">
                                    {{ post.title }}
                                </p>
                                <p class="text-black">
                                    {{ post.price }}€
                                </p>
                                <!-- Button group -->
                                <div class="card-flex justify-content-center">
                                    <button @click="openPostdetails(post.id)"
                                        class="btn btn-dark mb-3 img-zoom text-white"
                                        aria-label="Read More Button">
                                        <i class="bi bi-chevron-right"></i> Read More
                                    </button>
                                    <button v-if="$page.props.auth"
                                        class="btn btn-light border-none ms-2 px-2 py-0 btn-48"
                                        @click="toggleLike(post.id)"
                                        :aria-label="post.isLikedByUser ? 'Unlike Post Button' : 'Like Post Button'">
                                        <div class="card-flex align-items-center m-0">
                                            {{ post.likesCount }}
                                            <i class="bi h4 text-danger ms-1 mt-2"
                                                :class="{ 'bi-heart-fill': post.isLikedByUser, 'bi-heart': !post.isLikedByUser }"></i>
                                        </div>
                                    </button>
                                    <Link v-if="!$page.props.auth" :href="route('login')">
                                    <button class="btn btn-light border-none ms-2 px-2 py-2 btn-48"
                                        aria-label="Like Post Button">
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
        likedPosts: {
            type: Array,
            required: true,
        },
    },
    methods: {
        getImageUrl(path) {
            return `/storage/${path}`;
        },
        toggleLike(postId) {
            this.$inertia.post(`/posts/${postId}/like`, {}, { preserveScroll: true });
        },
        openPostdetails(postId) {
            let modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            modal.hide();
            this.$inertia.visit(`/Posts/${postId}`);
        }
    },
};
</script>

<style scoped>
.btn-48 {
    height: 48px;
}
</style>
