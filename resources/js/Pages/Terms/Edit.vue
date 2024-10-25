<template>
    <button type="button" class="btn btn-dark mb-3" data-bs-toggle="modal"
        :data-bs-target="'#editTermModal' + term.id">
        <i class="bi bi-pencil-square h5"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" :id="'editTermModal' + term.id" tabindex="-1"
        :aria-labelledby="'editTermModalLabel' + term.id" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title .text-black" :id="'editTermModalLabel' + term.id">Edit Term</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="handleSubmit">
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label for="title" class="text-dark">Title:</label><br />
                            <input v-model="form.title" type="text" name="title" id="title" class="form-control"
                                required minlength="3" maxlength="255" aria-describedby="'titleError' + term.id" />
                            <div v-if="errors.title" class="text-danger" :id="'titleError' + term.id">{{ errors.title }}
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password" class="text-dark">Term Text:</label><br />
                            <textarea v-model="form.content" name="content" id="content" cols="49" rows="5"
                                class="form-control" required minlength="3"
                                aria-describedby="'contentError' + term.id"></textarea>
                            <div v-if="errors.content" class="text-danger" :id="'contentError' + term.id">{{
                                errors.content }}</div>
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
        errors: Object,
        term: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const form = useForm({
            title: props.term.title,
            content: props.term.content,
        });

        const handleSubmit = () => {
            form.submit('put', route('terms.edit', props.term.id));
        };

        return { form, handleSubmit };
    },
};
</script>

<style scoped></style>
