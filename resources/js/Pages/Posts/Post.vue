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
                                    <li class="py-2 px-4 d-flex mb-2 mt-0 rounded background">
                                        <p class="mb-0 me-2 fw-bold">
                                            Category :
                                        </p>
                                        <span class="">{{ post.category.name }}</span>
                                    </li>
                                    <li class=" py-2 px-4 d-flex my-2 rounded background">
                                        <p class="mb-0 me-2 fw-bold">
                                            Author :
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
                                        <!-- Like Button -->
                                        <button v-if="$page.props.auth"
                                                class="btn btn-light border-none px-2 py-0 btn-48 like-button"
                                                :class="{ 'animate-click': isLikeAnimating }"
                                                @click="handleLikeClick(post.id)">
                                            <div class="d-flex align-items-center m-0">
                                                {{ post.likesCount || 0 }}
                                                <i class="bi h4 ms-1 mt-1"
                                                :class="{
                                                    'bi-hand-thumbs-up-fill text-success': post.isLikedByUser,
                                                    'bi-hand-thumbs-up text-success': !post.isLikedByUser
                                                }"></i>
                                            </div>
                                        </button>

                                        <!-- Dislike Button -->
                                        <button v-if="$page.props.auth"
                                                class="btn btn-light border-none px-2 py-0 btn-48 dislike-button"
                                                :class="{ 'animate-click': isDislikeAnimating }"
                                                @click="handleDislikeClick(post.id)">
                                            <div class="d-flex align-items-center m-0">
                                                {{ post.dislikesCount || 0 }}
                                                <i class="bi h4 ms-1 mt-1"
                                                :class="{
                                                    'bi-hand-thumbs-down-fill text-danger': post.isLikedByUser,
                                                    'bi-hand-thumbs-down text-danger': !post.isLikedByUser
                                                }"></i>
                                            </div>
                                        </button>
                                    </div>
                                     <div>
                                        <Comments :profilePhoto="profilePhoto" :errors="errors" :postId="post.id" :comments="comments" />
                                    </div>  
                                </div>
                            </div>

                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" aria-label="Post Image carousel">
    <div class="carousel-inner">
        <div 
            class="carousel-item" 
            v-for="(image, index) in postImages" 
            :key="index" 
            :class="{ active: index === 0 }">
            <img 
                :src="image" 
                class="d-block w-100 rounded img-fluid" 
                alt="Post Image" />
        </div>
    </div>
    <button 
        class="carousel-control-prev" 
        type="button" 
        data-bs-target="#carouselExample" 
        data-bs-slide="prev" 
        aria-label="Previous">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button 
        class="carousel-control-next" 
        type="button" 
        data-bs-target="#carouselExample"
        data-bs-slide="next" 
        aria-label="Next">
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
            isPressed: {},
            isLikeAnimating: false,
            isDislikeAnimating: false,
            isCommentsAnimating: false
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

        handleLikeClick(postId) {
            this.isLikeAnimating = true;
            setTimeout(() => {
                this.isLikeAnimating = false;
            }, 200);
            this.toggleLike(postId);
        },
        handleDislikeClick(postId) {
            this.isDislikeAnimating = true;
            setTimeout(() => {
                this.isDislikeAnimating = false;
            }, 200);
            this.toggleDislike(postId);
        },
        handleCommentsClick() {
            this.isCommentsAnimating = true;
            setTimeout(() => {
                this.isCommentsAnimating = false;
            }, 200);
            // Your existing comments logic
        }
        
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
.background{
    background-color: rgb(230,230,230);

}

.like-button, .dislike-button, .comments-button {
    transition: transform 0.2s ease;
}

.animate-click {
    animation: clickEffect 0.2s ease;
}

@keyframes clickEffect {
    0% {
        transform: scale(1);
        background-color: var(--bs-light);
    }
    50% {
        transform: scale(1.1);
        background-color: var(--bs-light);
    }
    100% {
        transform: scale(1);
        background-color: var(--bs-light);
    }
}

.like-button, .dislike-button {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

/* Separate animations for like and dislike */
.like-button.animate-click {
    animation: likeClickEffect 0.5s cubic-bezier(0.36, 0, 0.66, -0.56);
}

.dislike-button.animate-click {
    animation: dislikeClickEffect 0.5s cubic-bezier(0.36, 0, 0.66, -0.56);
}

@keyframes likeClickEffect {
    0% {
        transform: scale(1) rotate(0deg);
        background-color: var(--bs-light);
    }
    25% {
        transform: scale(1.2) rotate(5deg);
        background-color: rgba(40, 167, 69, 0.1); /* Light green */
    }
    50% {
        transform: scale(0.95) rotate(-5deg);
    }
    75% {
        transform: scale(1.1) rotate(3deg);
    }
    100% {
        transform: scale(1) rotate(0deg);
        background-color: var(--bs-light);
    }
}

@keyframes dislikeClickEffect {
    0% {
        transform: scale(1) rotate(0deg);
        background-color: var(--bs-light);
    }
    25% {
        transform: scale(1.2) rotate(5deg);
        background-color: rgba(220, 53, 69, 0.1); /* Light red */
    }
    50% {
        transform: scale(0.95) rotate(-5deg);
    }
    75% {
        transform: scale(1.1) rotate(3deg);
    }
    100% {
        transform: scale(1) rotate(0deg);
        background-color: var(--bs-light);
    }
}

/* Specific hover effects */
.like-button:hover {
    background-color: rgba(40, 167, 69, 0.1);
    transform: translateY(-2px);
}

.dislike-button:hover {
    background-color: rgba(220, 53, 69, 0.1);
    transform: translateY(-2px);
}

/* Icons animation */
.like-button i, .dislike-button i {
    transition: transform 0.2s ease;
}

.like-button:active i, .dislike-button:active i {
    transform: scale(1.2);
}
</style>