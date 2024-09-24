<template>
    <Layout>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center h-md-75 h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img :src="film" class="img-fluid rounded" alt="Sample image of a film">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form @submit.prevent="form.post('login')" aria-label="login form">
                        <div class="mb-4">
                            <div class="form-outline">
                                <label class="form-label " for="email">Email address</label>
                                <input type="email" v-model="form.email" id="email" name="email"
                                    class="form-control form-control-lg" placeholder="Your unique e-mail"
                                    aria-label="email input" />
                            </div>
                            <div v-if="errors.email" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.email }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-outline">
                                <label class="form-label mb-1" for="password">Password</label>
                                <input type="password" v-model="form.password" id="password" name="password"
                                    class="form-control form-control-lg" placeholder="Enter password"
                                    aria-label="password input" />
                            </div>
                            <div v-if="errors.password" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.password }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex mt-3 pt-2 justify-content-end">
                            <p class="small fw-bold mt-2 pt-1 mb-0 me-2">Don't have an account?
                                <Link :href="route('register')" class="link-primary" aria-label="register here link">
                                Register here</Link>
                            </p>
                            <button type="submit" class="btn btn-info .text-black"
                                aria-label="login button">Login</button>
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
            email: "",
            password: "",
        });

        return { form };
    },
};
</script>

<style scoped></style>