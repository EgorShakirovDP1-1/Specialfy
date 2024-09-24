<template>
    <div class="row justify-content-center text-center mx-auto">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" @submit.prevent="handleSubmit" aria-label="Change Password Form">
                <div class="form-group mt-3">
                    <label for="old_password" class="text-dark">Old Password:</label><br />
                    <input v-model="form.old_password" type="password" name="old_password" id="old_password"
                        class="form-control" aria-label="Old Password Input"
                        :aria-invalid="errors.old_password ? 'true' : 'false'"
                        :aria-describedby="errors.old_password ? 'oldPasswordError' : null" />
                    <div v-if="errors.old_password" class="d-block mt-2" id="oldPasswordError">
                        <span class="fs-5 text-danger" aria-live="assertive">{{ errors.old_password }}</span>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="text-dark">New Password:</label><br />
                    <input v-model="form.password" type="password" name="password" id="password" class="form-control"
                        aria-label="New Password Input" :aria-invalid="errors.password ? 'true' : 'false'"
                        :aria-describedby="errors.password ? 'passwordError' : null" />
                    <div v-if="errors.password" class="d-block mt-2" id="passwordError">
                        <span class="fs-5 text-danger" aria-live="assertive">{{ errors.password }}</span>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="password_confirmation" class="text-dark">Confirm Password:</label><br />
                    <input v-model="form.password_confirmation" type="password" name="password_confirmation"
                        id="password_confirmation" class="form-control" aria-label="Confirm Password Input"
                        :aria-invalid="errors.password_confirmation ? 'true' : 'false'"
                        :aria-describedby="errors.password_confirmation ? 'passwordConfirmationError' : null" />
                    <div v-if="errors.password_confirmation" class="d-block mt-2" id="passwordConfirmationError">
                        <span class="fs-5 text-danger" aria-live="assertive">{{ errors.password_confirmation }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center my-3">
                    <div class="form-group ms-3">
                        <button type="submit" :disabled="form.processing" class="btn btn-info text-primary py-2 px-3"
                            aria-label="Save Password Button">
                            Save Password
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
            old_password: props.user.password,
            password: null,
            password_confirmation: null
        });

        const handleSubmit = () => {
            form.submit('put', route('update', props.user.id));
        };

        return { form, handleSubmit };
    },
};
</script>

<style></style>
