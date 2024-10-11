<template>
    <Layout>
        <Message />
        <section class="p-4 bg-light">
            <div class="container">
                <h1 class="text-center mb-2 text-warning">
                    {{ film.filmname }} 
                </h1>
                <div class="px-5">
                    <div id="main-container" class="container">
                        <div class="d-flex">
                            <div id="statistics" class="me-2">
                                <ul class="list-unstyled mb-2">
                                    <li class="bg-black py-2 px-4 d-flex mb-2 mt-0 rounded">
                                        <p class="mb-0 me-2 fw-bold">Name:</p>
                                        <span class="">{{ film.author }}
                                            {{ film.model }}</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">Year:</p>
                                        <span class="">{{ film.year }}.</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Name :
                                        </p>
                                        <span class="">{{
                                            film.filmname
                                            }}</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Description:
                                        </p>
                                        <span class="">{{ film.description }}</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Genre:
                                        </p>
                                        <span class="">{{
                                            film.genre
                                            }}</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Duration:
                                        </p>
                                        <span class="">{{ film.duration }}</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Volume:
                                        </p>
                                        <span class="">{{ film.volume }}</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Price Per Subscribtion:
                                        </p>
                                        <span class="">{{ film.price_per_subscribtion }}€</span>
                                    </li>
                                    <li class="bg-black py-2 px-4 d-flex my-2 rounded">
                                        <p class="mb-0 me-2 fw-bold">
                                            Price Per watch:
                                        </p>
                                        <span class="">{{ film.price_per_watch }}€</span>
                                    </li>
                                </ul>
                                <div class="d-flex">
                                    <div>
                                        <button v-if="$page.props.auth"
                                            class="btn btn-light border-none px-2 py-0 btn-48"
                                            @click="toggleLike(film.id)">
                                            <div class="d-flex align-items-center m-0">
                                                {{ film.likesCount }}
                                                <i class="bi h4 text-danger ms-1 mt-2"
                                                    :class="{ 'bi-heart-fill': film.isLikedByUser, 'bi-heart': !film.isLikedByUser }"></i>
                                            </div>
                                        </button>
                                        <Link v-if="!$page.props.auth" :href="route('login')">
                                        <button class="btn btn-light border-none px-2 py-2 btn-48">
                                            <div class="d-flex align-items-center m-0">
                                                {{ film.raiting }}
                                                <i class="bi bi-heart h4 text-danger ms-1 mt-2"></i>
                                            </div>
                                        </button>
                                        </Link>
                                    </div>
                                    <div>
                                        <Comments :profilePhoto="profilePhoto" :errors="errors" :filmId="film.id"
                                            :comments="comments" />
                                    </div>
                                </div>
                            </div>

                            <div id="carouselExample" class="carousel slide" aria-label="Film Image carousel">
                                <div class="ousel-inner">
                                    <div class="carousel-item active">
                                        <img :src="film.filmImage1" class="d-block w-100 rounded" alt="Film Image 1" />
                                    </div>
                                    <div class="carousel-item" v-for="(FilmImage, index) in filmImages" :key="index">
                                        <img :src="FilmImage" class="d-block w-100 rounded" alt="Film Image" />
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

            <form @submit.prevent="submitForm" class="mt-5">
                <h1 class="text-warning text-center mb-0">Rent a film</h1>
                <div class="container mt-5">
                    <div class="text-center">
                        <div class="d-flex justify-content-around">
                            <div class="mb-4">
                                <div class="mb-2">
                                    <label class="text-white mb-2" for="start_date">Starting Date</label>
                                    <input v-model="form.start_date"
                                        class="form-control form-control-md input-small mx-auto" type="date"
                                        id="start_date" />
                                </div>
                                <div v-if="errors.start_date" class="d-block mt-2">
                                    <span class="fs-5 text-danger">
                                        {{ errors.start_date }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="mb-2">
                                    <label class="text-white mb-2" for="end_date">End Date</label>
                                    <input v-model="form.end_date"
                                        class="form-control form-control-md input-small mx-auto" type="date"
                                        id="end_date" />
                                </div>
                                <div v-if="errors.end_date" class="d-block mt-2">
                                    <span class="fs-5 text-danger">
                                        {{ errors.end_date }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-around">
                            <div class="mb-4">
                                <div class="mb-2">
                                    <label class="text-white mb-2" for="watch">How many times you wish to watch?</label>
                                    <input v-model="form.watch"
                                        class="form-control form-control-md input-small mx-auto" type="number"
                                        id="watch" placeholder="1-10 watch" />
                                </div>
                                <div v-if="errors.watch" class="d-block mt-2">
                                    <span class="fs-5 text-danger">
                                        {{ errors.watch }}
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="mb-2">
                                    <label class="text-white mb-2" for="start_date">Starting Time</label>
                                    <input v-model="form.start_date"
                                        class="form-control form-control-md input-small mx-auto" type="time"
                                        id="start_date" />
                                </div>
                                <div v-if="errors.start_date" class="d-block mt-2">
                                    <span class="fs-5 text-danger">
                                        {{ errors.start_date }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-around">
                            <div class="mb-3">
                                <label class="text-white mb-2" for="startingPoint">Select starting point</label>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        {{
                                            form.film_pickup_place
                                                ? form.film_pickup_place
                                                : "Select Starting Point"
                                        }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <p class="dropdown-item mb-0" @click="
                                                form.film_pickup_place =
                                                'Lidosta Rīga'
                                                ">
                                                Lidosta Rīga
                                            </p>
                                        </li>
                                        <li>
                                            <p class="dropdown-item mb-0" @click="
                                                form.film_pickup_place =
                                                'Aspazijas bulvāris 32'
                                                ">
                                                Aspazijas bulvāris 32
                                            </p>
                                        </li>
                                        <li>
                                            <p class="dropdown-item mb-0" @click="
                                                form.film_pickup_place =
                                                'Brīvības iela 366'
                                                ">
                                                Brīvības iela 366
                                            </p>
                                        </li>
                                        <li>
                                            <input v-model="form.film_pickup_place" class="form-control" type="text"
                                                placeholder="Enter custom starting point" />
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-white mb-2" for="endingPoint">Select Ending point</label>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        {{
                                            form.film_return_place
                                                ? form.film_return_place
                                                : "Select Starting Point"
                                        }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <p class="dropdown-item mb-0" @click="
                                                form.film_return_place =
                                                'Lidosta Rīga'
                                                ">
                                                Lidosta Rīga
                                            </p>
                                        </li>
                                        <li>
                                            <p class="dropdown-item mb-0" @click="
                                                form.film_return_place =
                                                'Aspazijas bulvāris 32'
                                                ">
                                                Aspazijas bulvāris 32
                                            </p>
                                        </li>
                                        <li>
                                            <p class="dropdown-item mb-0" @click="
                                                form.film_return_place =
                                                'Brīvības iela 366'
                                                ">
                                                Brīvības iela 366
                                            </p>
                                        </li>
                                        <li>
                                            <input v-model="form.film_return_place" class="form-control" type="text"
                                                placeholder="Enter custom starting point" />
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <p class="text-white mb-2" for="totalPrice">
                                Total Price:
                            </p>
                            <h4 class="text-warning">{{ totalPrice }}€</h4>
                        </div>
                    </div>
                </div>

                <div v-if="$page.props.auth" class="my-4 text-center img-zoom">
                    <button type="submit" class="btn btn-info text-primary py-3 px-4">
                        Rent Your Film!
                    </button>
                </div>

                <div v-if="!$page.props.auth" class="my-4 text-center img-zoom">
                    <Link :href="route('login')" class="btn btn-info text-primary py-3 px-4">
                    Login to rent!
                    </Link>
                </div>

            </form>
        </section>
        <ContactUs />
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import ContactUs from "../Home/Components/ContactUs.vue";
import { Link, useForm } from "@inertiajs/vue3";
import Comments from "../Films/Comments.vue";
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
        film: {
            type: Object,
            required: true,
        },
        filmImages: {
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
            film_pickup_place: "",
            film_return_place: "",
            start_date: "",
            end_date: "",
            start_date: "",
            filmId: props.film.id,
            end_price: 0
        });

        const calculateTripDuration = () => {
            const endDate = new Date(form.end_date);
            const startDate = new Date(form.start_date);

            const tripDuration = Math.ceil((endDate.getTime() - startDate.getTime()) / (1000 * 3600 * 24))

            return tripDuration;
        };

        const calculateTotalPrice = () => {
            const pricePerSubscribtion = props.film.price_per_subscribtion;
            const pricePerwatch = props.film.price_per_watch;

            const tripDuration = calculateTripDuration();

            const totalSubscribtionsPrice = tripDuration * pricePerSubscribtion;
            const totalwatchPrice = form.watch * pricePerwatch;

            let totalPrice = totalSubscribtionsPrice + totalwatchPrice;

            const startingAddresses = ['Lidosta Rīga', 'Aspazijas bulvāris 32', 'Brīvības iela 366'];

            const endingAddresses = ['Lidosta Rīga', 'Aspazijas bulvāris 32', 'Brīvības iela 366'];

            if (!startingAddresses.includes(form.film_pickup_place)) {
                totalPrice += 10;
            }

            if (!endingAddresses.includes(form.film_return_place)) {
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
            form.post(`/films/${props.film.id}`);
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
        toggleLike(filmId) {
            this.$inertia.post(`/films/${filmId}/like`, {}, { preserveScroll: true })
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
</style>