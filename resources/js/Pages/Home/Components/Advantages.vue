<template>
    <section class="box-size" aria-labelledby="filmSharingBenefitsHeading">
        <div class="container text-center">
            <div class="row justify-content-center mt-2">
                <div class="col-lg-5" s>
                    <div class="text-center text-white">
                        <h3 class="mb-2 display-4 text-white">Find your specialist!</h3>
                        <Link :href="route('posts')"><button class="btn btn-danger mt-4 text-white">Get Started</button></Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
export default {
  name: 'PostSharingBenefits',
  components: {
        Link,
    },
};
</script>

<style>

    .box-size {
        padding-top: 10rem;  /* Adjust as needed */
        padding-bottom: 10rem; /* Adjust as needed */
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('../../../../../public/images/homepage.png'); /* Replace with your image path */
        background-size: cover;       /* Cover the entire section */
        background-position: center;  /* Center the image */
        background-repeat: no-repeat; /* Avoid repeating the image */
    }

</style>
