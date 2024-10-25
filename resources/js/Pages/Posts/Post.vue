<template>
    <Layout>
        <Message />
        <section class="p-4 bg-light">
            <div class="container">
                <h1 class="text-center mb-2 text-black">
                    {{ post.title }} 
                </h1>
                <div class="px-5">
                    <div id="main-container" class="container">
                        <div class="d-flex">
                            <div id="statistics" class="me-2">
                                <ul class="list-unstyled mb-2">
                                    <li class="py-2 px-4 d-flex mb-2 mt-0 rounded background">
                                        <p class="mb-0 me-2 fw-bold">Name:</p>
                                        <span class="">
                                            {{ post.title }}</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Category :
                                        </p>
                                        <span class="">{{ post.category_id.name }}</span>
                                    </li>
                                    <li class=" py-2 px-4 d-flex my-2 rounded background">
                                        <p class="mb-0 me-2 fw-bold">
                                            Autor :
                                        </p>
                                        <span class="">{{ post.user_id }}</span>
                                    </li>
                                    <li class="py-2 px-4 d-flex my-2 rounded background">
                                        <p class="mb-0 me-2 fw-bold">
                                            Description:
                                        </p>
                                        <span class="">{{ post.text }}</span>
                                    </li>
                                    

                                    
                                    <li class="py-2 px-4 d-flex my-2 rounded background">
                                        <p class="mb-0 me-2 fw-bold">
                                            Price:
                                        </p>
                                        <span class="">{{ post.price }}€</span>
                                    </li>
                                    
                                </ul>
                                <div class="d-flex">
                                    <div>
                                        <button v-if="$page.props.auth"
                                                class="btn btn-light border-none px-2 py-0 btn-48"
                                                @click="toggleLike(post.id)">
                                            <div class="d-flex align-items-center m-0">
                                                {{ post.likesCount || 0 }}  <!-- Display 0 if undefined -->
                                                <i class="bi h4 text-success ms-1 mt-2"
                                                :class="{ 'bi-hand-thumbs-up-fill': post.isLikedByUser, 'bi-hand-thumbs-up': !post.isLikedByUser }"></i>
                                            </div>
                                        </button>

                                        <!-- Dislike Button -->
                                        <button v-if="$page.props.auth"
                                                class="btn btn-light border-none px-2 py-0 btn-48"
                                                @click="toggleDislike(post.id)">
                                            <div class="d-flex align-items-center m-0">
                                                {{ post.dislikesCount || 0 }}  <!-- Display 0 if undefined -->
                                                <i class="bi h4 text-danger ms-1 mt-2"
                                                :class="{ 'bi-hand-thumbs-down-fill': post.isDislikedByUser, 'bi-hand-thumbs-down': !post.isDislikedByUser }"></i>
                                            </div>
                                        </button>
                                    </div>
                                     <div>
                                        <Comments :profilePhoto="profilePhoto" :errors="errors" :postId="post.id" :comments="comments" />
                                    </div>  
                                </div>
                            </div>

                            <div id="carouselExample" class="carousel slide" aria-label="Post Image carousel">
    <div class="carousel-inner">
        <div class="carousel-item" v-for="(image, index) in postImages" :key="index" :class="{ active: index === 0 }">
            <img :src="image" class="d-block w-100 rounded" alt="Post Image" />
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="carouselExample" data-bs-slide="prev" aria-label="Previous">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="carouselExample" data-bs-slide="next" aria-label="Next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

                        </div>
                    </div>
                </div>
            </div>

            
        </section>
        <ContactUs />
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import ContactUs from "../Home/Components/ContactUs.vue";
import { Link } from "@inertiajs/vue3";
import Comments from "../Posts/Comments.vue";
import Message from "../Home/Components/Message.vue";


export default {
    components: {
        Layout,
        ContactUs,
        Link,
        Comments,
        Message,
    },
    props: {
        errors: Object,
        post: {
            type: Object,
            required: true,
        },
         postImages: {
             type: Array,
             required: true,
        },
        // profilePhoto: {
        //     type: Image,
        //     required: true,
        // },
        comments: {
            type: Array,
            required: true,
        },
     
    },
    
       

     

    data() {
        return {
            isPressed: {}
        }
    },
    
    methods: {
        toggleLike(postId) {
            const post = this.post;

            this.$inertia.post(`/Posts/${postId}/toggleLike`, { action: 'like' })
        
    },

    toggleDislike(postId) {
    const post = this.post;

    this.$inertia.post(`/Posts/${postId}/toggleLike`, { action: 'dislike' })
       
},

        
    },
    mounted() {
        let modalBackdrop = document.querySelector('.modal-backdrop');
        if (modalBackdrop) {
            modalBackdrop.remove();
        }

        document.body.style.overflow = 'auto';
    },
};
</script>

<style scoped>     
#main-container {
    min-height: 600px;
}

#statistics {
    min-width: 300px;
}

.carousel-inner {
    height: 600px;
}

.carousel-item img {
    min-width: 860px;
}

input {
    width: 400px;
}

.btn-48 {
    height: 48px;
}

.container {
    margin-bottom: 300px;
}
.background{
    background-color: rgb(230,230,230);

}
</style>