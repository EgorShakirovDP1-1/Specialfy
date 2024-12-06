<template>
    <div class="row justify-content-center text-center mx-auto">
        <div class="col-12 col-sm-8 col-md-6">
            <form enctype="multipart/form-data" class="form mt-5" @submit.prevent="submitAvatar"
                aria-label="Profile Image Form">
                <div class="form-group mt-3">
                    <label for="avatar" class="text-dark">Profile Image:</label><br />
                    <input type="file" name="avatar" id="avatar" class="form-control border-primary"
                        @input="form.avatar = $event.target.files[0]" aria-label="Upload Profile Image" />
                    <div v-if="errors.avatar" class="d-block mt-2">
                        <span class="fs-5 text-danger" aria-live="assertive">
                            {{ errors.avatar }}
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center my-3">
                    <div class="form-group ms-3">
                        <button type="submit" class="btn btn-dark text-white py-2 px-3"
                            aria-label="Save Profile Image Button">
                            Save Profile Image
                        </button>
                    </div>
                    <div class="form-group ms-3">
                        <button type="button" class="btn btn-danger text-white py-2 px-3"
                            @click="deleteAvatar" aria-label="Delete Profile Image Button">
                            Delete Profile Image
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    avatar: String,
    id: String,
    errors: Object,
});

const form = useForm({
    avatar: "",
});

function submitAvatar() {
    router.post(`/profile/${props.id}/edit`, {
        _method: "put",
        forceFormData: true,
        avatar: form.avatar,
    });
}

function deleteAvatar() {
    router.delete(`/profile/${props.id}/avatar`);
}
</script>
