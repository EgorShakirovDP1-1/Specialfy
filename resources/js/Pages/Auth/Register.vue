<template>
    <Layout>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center h-md-75 h-100">
                <div class="col-md-8 col-lg-1 col-xl-5">
                    <img :src="film" class="img-fluid rounded" alt="Sample image of a film">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form @submit.prevent="form.post('register')" aria-label="registration form">
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label mb-1" for="name">Full name</label>
                                <input type="text" v-model="form.name" id="name" name="name" class="form-control"
                                    placeholder="Enter a valid username" aria-label="full name input" />
                            </div>
                            <div v-if="errors.name" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.name }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label mb-1" for="phone_number">Phone number</label>
                                <input type="text" v-model="form.phone_number" id="phone_number" name="phone_number"
                                    class="form-control" placeholder="Enter a valid phone number"
                                    aria-label="phone number input" />
                            </div>
                            <div v-if="errors.phone_number" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.phone_number }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label mb-1" for="email">Email address</label>
                                <input type="email" v-model="form.email" id="email" name="email" class="form-control"
                                    placeholder="Enter a valid email address" aria-label="email input" />
                            </div>
                            <div v-if="errors.email" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.email }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label mb-1" for="password">Password</label>
                                <input type="password" v-model="form.password" id="password" name="password"
                                    class="form-control" placeholder="Enter password" aria-label="password input" />
                            </div>
                            <div v-if="errors.password" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.password }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label mb-1" for="password_confirmation">Confirm password</label>
                                <input type="password" v-model="form.password_confirmation" id="password_confirmation"
                                    name="password_confirmation" class="form-control"
                                    placeholder="Enter password confirmation" aria-label="confirm password input" />
                            </div>
                            <div v-if="errors.password_confirmation" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.password_confirmation }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex mt-3 pt-2 justify-content-end">
                            <p class="small fw-bold mt-2 pt-1 mb-0 me-2">If you already have an account?
                                <Link :href="route('login')" class="link-primary" aria-label="login link">Login here
                                </Link>
                            </p>
                            <button type="submit" class="btn btn-info .text-black"
                                aria-label="register button">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        Layout,
        Link,
    },
    props: {
        errors: Object,
        film: {
            type: Image,
            required: true,
        }
    },
    setup() {
        const form = useForm({
            name: "",
            phone_number: "",
            email: "",
            password: "",
            password_confirmation: "",
        });

        return { form };
    },
};
</script>

<style scoped></style>
