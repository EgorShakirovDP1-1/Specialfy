<template>
    <button type="button" class="btn btn-dark d-block py-2" style="width: 216px;" data-bs-toggle="modal"
        data-bs-target="#myPostsModal" aria-label="My Posts Button">
        <i class="bi bi-person-fill me-2"></i> My Posts
    </button>

    <!-- Modal for My Posts -->
    <div class="modal fade" id="myPostsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="myPostsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header justify-content-around">
                    <h5 class="modal-title" id="myPostsModalLabel">My Posts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-evenly">
                        <div 
                            class="col-lg-3 col-md-5 py-4 px-3 m-3 bg-light text-black border-primary rounded d-flex flex-column"
                            v-for="post in myPosts" 
                            :key="post.id" 
                            role="listitem">
                            <img :src="post.postImage1" class="d-img-top img-fluid rounded mb-3" alt="Post Image" />
                            <div class="d-body flex-grow-1">
                                <h4 class="d-title">
                                    {{ post.author }} {{ post.model }}
                                </h4>
                                <p class="text-black mb-0">
                                    {{ post.title }}
                                </p>
                                <p class="text-black">
                                    Price: {{ post.price }}€
                                </p>
                            </div>

                            <!-- Bottom-aligned section -->
                            <div class="d-flex justify-content-center align-items-center m-2">
                                <button 
                                    @click="openPostdetails(post.id)" 
                                    class="readmore-btn btn border border-black img-zoom text-black" 
                                    aria-label="Read More Button">
                                    Read More
                                </button>

                                <button 
                                    @click="destroy(post.id)" 
                                    class="btn btn-danger img-zoom text-black py-2 ms-2" 
                                    aria-label="Delete Post">
                                    Delete
                                </button>

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
import { Link, router } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        myPosts: {
            type: Array,
            required: true,
        },
    },
    methods: {
        toggleLike(postId) {
            this.$inertia.post(`/posts/${postId}/like`, {}, { preserveScroll: true });
        },
        openPostdetails(postId) {
            let modal = new bootstrap.Modal(document.getElementById('myPostsModal'));
            modal.hide();
            this.$inertia.visit(`/Posts/${postId}`);
        },
        destroy(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                router.delete(route("post.destroy", postId ));
            }
        },
    },
};
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

.readmore-btn{
    background: rgb(230,230,230);
}
</style>