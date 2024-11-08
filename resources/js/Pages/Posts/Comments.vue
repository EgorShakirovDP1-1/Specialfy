<template>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-light border-none px-3 py-2 ms-2 btn-48" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop" aria-label="Open Comments Modal">
        <i class="bi bi-chat-left-text text-primary h4" aria-hidden="true"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div id="commentModal" class="modal-dialog modal-lg" role="dialog" aria-label="Comments Modal">
        <div class="modal-content p-5">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title mb-3" id="staticBackdropLabel">Comments</h5>
                <button type="button" class="btn-close mb-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-genre">
                <form @submit.prevent="handleSubmit">
                    <div class="form-group d-flex align-items-center pb-2">
                        <img v-if="$props.auth" :src="profilePhoto" alt="profile photo" class="rounded-circle profile-photo me-2">
                        <img v-else src="/public/images/default-profile.png" alt="profile photo" class="rounded-circle profile-photo me-2">
                        
                        <textarea v-model="form.comment" name="comment" id="comment" rows="2"
                            class="flex-grow-1 rounded form-control" placeholder="Write a comment..." 
                            style="resize: none; overflow-y: auto;">
                        </textarea>
                        
                        <button type="submit" :disabled="form.processing"
                            class="btn btn-dark px-3 py-2 ms-4">Save</button>
                    </div>

                    <div class="d-block mt-2 text-center" v-if="errors.comment" role="alert" aria-live="assertive">
                        <span class="fs-5 text-danger">
                            {{ errors.comment }}
                        </span>
                    </div>
                </form>

                <hr>
                <div class="text-center" v-if="!comments.length" role="status" aria-live="polite">
                    Comments will be displayed here
                </div>
                <div class="rounded commentoutput mb-3 p-3 d-flex align-items-start" v-for="comment in comments" :key="comment.id">
                    <div class="d-flex flex-grow-1">
                        <img :src="comment.profilePhoto" alt="" class="rounded-circle profile-photo mt-3 me-2 flex-shrink-0">
                        <div class="mb-3 w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 text-black">{{ comment.name }}</h6>
                            </div>
                            <p class="mb-1 text-primary text-wrap" style="word-break: break-word;">{{ comment.comment }}</p>
                        </div>
                    </div>
                    <div class="ms-auto d-flex align-items-center py-3">
                        <button v-if="$page.props.auth && $page.props.auth.id === comment.user_id"
                            @click="destroy(comment.id, comment.post_id)" type="submit"
                            class="btn btn-danger ms-2 ps-3 pe-3 py-2" aria-label="Delete Comment">
                            <i class="bi bi-trash h4" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</template>

<script>
import { Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from 'vue';
import { router } from "@inertiajs/vue3";

export default {
    components: {
        Link
    },
    props: {
        errors: Object,
        profilePhoto: {
            type: Image,
            required: true,
        },
        postId: {
            type: Number,
            required: true,
        },
        comments: {
            type: Array
        },
    },
    setup(props) {
        const form = useForm({
            comment: "",
            post_id: props.postId,
        });

        const formEdit = useForm({
            comment: "",
            comment_id: "",
            post_id: props.postId,
        });

        let bsModal = null;

        onMounted(() => {
            bsModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        });

        const handleSubmit = () => {
            form.submit("post", route("comment", { post: props.postId }))
            form.comment = "";
        };

        const handleEditSubmit = (comment_text, post_id, comment_id) => {
            formEdit.comment = comment_text;
            formEdit.comment_id = comment_id;
            router.put(route("comment.update", { post: post_id, comment: comment_id }), formEdit, {
                onSuccess: () => {
                    comment.editing = false;
                }
            });
        };

        
        const destroy = (comment_id, post_id) => {
            if (confirm("Are you sure?")) {
                router.delete(route("comment.delete", { post: post_id, comment: comment_id, post_id, comment_id }));
            }
        };

        return { form, handleSubmit, destroy, handleEditSubmit };
    },
}
</script>

<style scoped>
.btn-48 {
    height: 48px;
}

.profile-photo {
    width: 48px;
    height: 48px;
}

.form-control {

    background-color: rgb(230, 230, 230);
    color: black;
}
.form-control::placeholder{
    color: rgb(100,100,100);
}

.commentoutput{
    background-color: rgb(230, 230, 230);
    
}




</style>

