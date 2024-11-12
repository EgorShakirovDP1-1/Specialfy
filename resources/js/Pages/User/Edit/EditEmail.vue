<template>
    <div class="row justify-content-center text-center mx-auto">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" @submit.prevent="handleSubmit" aria-label="Email Form">
                <div class="form-group mt-3">
                    <label for="email" class="text-dark">Email:</label><br />
                    <input v-model="form.email" type="email" name="email" id="email" class="form-control border-primary"
                        aria-label="Email Input" :aria-invalid="errors.email ? 'true' : 'false'"
                        :aria-describedby="errors.email ? 'emailError' : null" />
                    <div class="d-block mt-2" v-if="errors.email" id="emailError">
                        <span class="fs-5 text-danger" aria-live="assertive">
                            {{ errors.email }}
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center my-3">
                    <div class="form-group ms-3">
                        <button type="submit" :disabled="form.processing" class="btn btn-dark text-white py-2 px-3"
                            aria-label="Save Email Button">
                            Save Email
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        errors: Object,
        user: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const form = useForm({
            email: props.user.email,
        });

        const handleSubmit = () => {
            form.submit('put', route('update', props.user.id));
        };

        return { form, handleSubmit };
    },
};
</script>

<style></style>
