<template>
    <div class="row justify-content-center text-center mx-auto">
        <div class="col-12 col-sm-8 col-md-6">
            <form
                class="form mt-5"
                @submit.prevent="handleSubmit"
            >
                <div class="form-group mt-3">
                    <label for="name" class="text-dark">Name:</label><br />
                    <input
                        v-model="form.name"
                        type="text"
                        name="name"
                        id="name"
                        class="form-control border-primary"
                    />
                    <div class="d-block mt-2" v-if="errors.name">
                        <span class="fs-5 text-danger">
                            {{ errors.name }}
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center my-3">
                    <div class="form-group ms-3">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="btn btn-dark text-white text-primary py-2 px-3">
                            Save Name
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
            name: props.user.name,
        });

        const handleSubmit = () => {
            form.submit('put', route('update', props.user.id));
        };

        return { form, handleSubmit };
    },
};
</script>

<style></style>
