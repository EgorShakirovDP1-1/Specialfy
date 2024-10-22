<template>
    <Layout>
        <Message />
        <section class="p-4 bg-light">
            <div class="container">
                <h1 class="text-center mb-2 text-warning">
                    {{ post.postname }} 
                </h1>
                <div class="px-5">
                    <div id="main-container" class="container">
                        <div class="d-flex">
                            <div id="statistics" class="me-2">
                                <ul class="list-unstyled mb-2">
                                    <li class="bg-light py-2 px-4 d-flex mb-2 mt-0 rounded">
                                        <p class="mb-0 me-2 fw-bold">Name:</p>
                                        <span class="">{{ post.author }}
                                            {{ post.model }}</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">Year:</p>
                                        <span class="">{{ post.year }}.</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Name :
                                        </p>
                                        <span class="">{{
                                            post.postname
                                            }}</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Description:
                                        </p>
                                        <span class="">{{ post.description }}</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Genre:
                                        </p>
                                        <span class="">{{
                                            post.genre
                                            }}</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Duration:
                                        </p>
                                        <span class="">{{ post.duration }}</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Volume:
                                        </p>
                                        <span class="">{{ post.volume }}</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Price Per Subscribtion:
                                        </p>
                                        <span class="">{{ post.price_per_subscribtion }}€</span>
                                    </li>
                                    <li class="bg-light py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Price Per watch:
                                        </p>
                                        <span class="">{{ post.price_per_watch }}€</span>
                                    </li>
                                </ul>
                                <div class="d-flex">
                                    <div>
                                        <button v-if="$page.props.auth"
                                            class="btn btn-light border-none px-2 py-0 btn-48"
                                            @click="toggleLike(post.id)">
                                            <div class="d-flex align-items-center m-0">
                                                {{ post.likesCount }}
                                                <i class="bi h4 text-danger ms-1 mt-2"
                                                    :class="{ 'bi-heart-fill': post.isLikedByUser, 'bi-heart': !post.isLikedByUser }"></i>
                                            </div>
                                        </button>
                                        <Link v-if="!$page.props.auth" :href="route('login')">
                                        <button class="btn btn-light border-none px-2 py-2 btn-48">
                                            <div class="d-flex align-items-center m-0">
                                                {{ post.raiting }}
                                                <i class="bi bi-heart h4 text-danger ms-1 mt-2"></i>
                                            </div>
                                        </button>
                                        </Link>
                                    </div>
                                    <div>
                                        <Comments :profilePhoto="profilePhoto" :errors="errors" :postId="post.id"
                                            :comments="comments" />
                                    </div>
                                </div>
                            </div>

                            <div id="carouselExample" class="carousel slide" aria-label="Post Image carousel">
                                <div class="ousel-inner">
                                    <div class="carousel-item active">
                                        <img :src="post.postImage1" class="d-block w-100 rounded" alt="Post Image 1" />
                                    </div>
                                    <div class="carousel-item" v-for="(PostImage, index) in postImages" :key="index">
                                        <img :src="PostImage" class="d-block w-100 rounded" alt="Post Image" />
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="carouselExample"
                                    data-bs-slide="prev" aria-label="Previous">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="carouselExample"
                                    data-bs-slide="next" aria-label="Next">
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
import { Link, useForm } from "@inertiajs/vue3";
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
        profilePhoto: {
            type: Image,
            required: true,
        },
        comments: {
            type: Array,
            required: true,
        },
    },
    setup(props) {
        const form = useForm({
            watch: null,
            post_pickup_place: "",
            post_return_place: "",
            start_date: "",
            end_date: "",
            start_date: "",
            postId: props.post.id,
            end_price: 0
        });

        const calculateTripDuration = () => {
            const endDate = new Date(form.end_date);
            const startDate = new Date(form.start_date);

            const tripDuration = Math.ceil((endDate.getTime() - startDate.getTime()) / (1000 * 3600 * 24))

            return tripDuration;
        };

        const calculateTotalPrice = () => {
            const pricePerSubscribtion = props.post.price_per_subscribtion;
            const pricePerwatch = props.post.price_per_watch;

            const tripDuration = calculateTripDuration();

            const totalSubscribtionsPrice = tripDuration * pricePerSubscribtion;
            const totalwatchPrice = form.watch * pricePerwatch;

            let totalPrice = totalSubscribtionsPrice + totalwatchPrice;

            const startingAddresses = ['Lidosta Rīga', 'Aspazijas bulvāris 32', 'Brīvības iela 366'];

            const endingAddresses = ['Lidosta Rīga', 'Aspazijas bulvāris 32', 'Brīvības iela 366'];

            if (!startingAddresses.includes(form.post_pickup_place)) {
                totalPrice += 10;
            }

            if (!endingAddresses.includes(form.post_return_place)) {
                totalPrice += 10;
            }

            if (totalPrice >= 1000) {
                totalPrice *= 0.85;
            } else if (totalPrice >= 500) {
                totalPrice *= 0.9;
            } else if (totalPrice >= 200) {
                totalPrice *= 0.94;
            } else if (totalPrice >= 100) {
                totalPrice *= 0.97;
            }

            totalPrice = parseFloat(totalPrice.toFixed(2));

            return totalPrice;
        };

        const submitForm = () => {
            const totalPrice = calculateTotalPrice();
            form.end_price = totalPrice;
            form.post(`/posts/${props.post.id}`);
        };

        return { form, calculateTotalPrice, submitForm };
    },
    computed: {
        totalPrice() {
            return this.calculateTotalPrice();
        },
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
</style>