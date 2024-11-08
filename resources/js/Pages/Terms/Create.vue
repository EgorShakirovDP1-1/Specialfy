<template>
    <div v-if="$page.props.isAdmin" class="d-flex justify-content-center mt-3">
        <button type="button" class="btn btn-danger pb-2" data-bs-toggle="modal"
            data-bs-target="#createTermModal">
            <div class="d-flex">
                Create new Term
            </div>
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createTermModal" tabindex="-1" aria-labelledby="createTermModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTermModalLabel">Create New Term</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="handleSubmit">
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label for="title" class="text-dark">Title:</label><br />
                            <input v-model="form.title" type="text" name="title" id="title" class="form-control"
                                aria-describedby="titleHelp" />
                            <div class="d-block mt-2" v-if="errors.title">
                                <span class="fs-5 text-danger" id="titleHelp">
                                    {{ errors.title }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password" class="text-dark">Term Text:</label><br />
                            <textarea v-model="form.content" name="content" id="content" class="form-control" cols="49"
                                rows="5" aria-describedby="contentHelp"></textarea>
                            <div class="d-block mt-2" v-if="errors.content">
                                <span class="fs-5 text-danger" id="contentHelp">
                                    {{ errors.content }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" name="submit"
                                class="btn btn-primary btn-md h3 text-warning">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";

export default {
    props: {
        errors: {
            type: Object,
            required: true,
        },
        terms: {
            type: Array,
            required: true,
        },
    },
    setup() {
        const form = useForm({
            title: "",
            content: "",
        });

        const handleSubmit = () => {
            form.submit("post", route("terms.create"));
        };

        return { form, handleSubmit };
    },
};
</script>

<style scoped></style>
