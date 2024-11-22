<template>
    <Layout>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center h-md-75 h-100">
                <div class="col-md-8 col-lg-1 col-xl-5">
                    <img :src="post" class="img-fluid rounded" alt="Sample image of a listing">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-5">
                    <form @submit.prevent="form.post('register')" aria-label="registration form">
                        <div class="mb-3">
                            <p class="text-center text-black header"> Registration </p>
                            <div class="form-outline">
                                <label class="form-label text-black mb-1" for="name">Full name</label>
                                <input type="text" v-model="form.name" minlength="3" maxlength="25" id="name" name="name"
                                    class="rounded form-control "
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
                                <label class="form-label text-black mb-1" for="phone_number">Phone number</label>
                                <input type="tel" minlength="8" maxlength="11" v-model="form.phone_number" 
       id="phone_number" name="phone_number"
       class="rounded form-control" placeholder="+371XXXXXXXX"
       aria-label="phone number input" pattern="^\+?[0-9]{8,11}$" />

                                <span id="phone-error" class="text-danger"></span>
                            </div>
                            <div v-if="errors.phone_number" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.phone_number }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label text-black mb-1" for="email">Email address</label>
                                <input type="email" v-model="form.email" id="email" name="email" minlength="3" maxlength="50" class="rounded form-control "
                                    placeholder="example@example.com" aria-label="email input" />
                            </div>
                            <div v-if="errors.email" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.email }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
    <div class="form-outline">
        <label class="form-label text-black mb-1" for="user-type">Who are you</label>
        
        <!-- Buttons to set user_type to either 0 or 1 -->
        <button 
            type="button" 
            @click="form.user_type = 0" 
            :class="{'btn-primary': form.user_type === 0, 'btn-outline-primary': form.user_type !== 0}" 
            class="rounded btn me-2">
            Individual entity
        </button>
        
        <button 
            type="button" 
            @click="form.user_type = 1" 
            :class="{'btn-primary': form.user_type === 1, 'btn-outline-primary': form.user_type !== 1}" 
            class="rounded btn">
            Legal entity
        </button>
    </div>

    <!-- Error display for user_type -->
    <div v-if="errors.user_type" class="d-block mt-1">
        <span class="fs-5 text-danger">
            {{ errors.user_type }}
        </span>
    </div>
</div>
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label text-black mb-1" for="password">Password</label>
                                <input type="password" v-model="form.password" id="password" name="password"
                                    class="rounded form-control " placeholder="Enter password" aria-label="password input" />
                            </div>
                            <div v-if="errors.password" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.password }}
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-outline">
                                <label class="form-label text-black mb-1" for="password_confirmation">Confirm password</label>
                                <input type="password" v-model="form.password_confirmation" id="password_confirmation"
                                    name="password_confirmation" class="rounded form-control "
                                    placeholder="Enter password confirmation" aria-label="confirm password input" />
                            </div>
                            <div v-if="errors.password_confirmation" class="d-block mt-1">
                                <span class="fs-5 text-danger">
                                    {{ errors.password_confirmation }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex mt-3 pt-2 text-black justify-content-end">
                            <p class="medium fw-bold mt-2 pt-1 mb-0 me-2">If you already have an account?
                                <Link :href="route('login')" class="link-primary" aria-label="login link">Login here
                                </Link>
                            </p>
                            <button type="submit" class="btn btn-dark"
                                aria-label="register button">Sign up</button>
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
        post: {
            type: Image,
            required: true,
        }
    },
    setup() {
        const form = useForm({
            name: "",
            phone_number: "",
            email: "",
            user_type: "",
            password: "",
            password_confirmation: "",
        })
        return { form };
    },
};
</script>

<style scoped>
.form-control {

/* border-radius: 10px; */
background-color: rgb(230, 230, 230);
color: black;
}
.form-control::placeholder{

color: rgb(55, 55, 55);
}

.header {
    font-size: xx-large;
}
</style>