<template>
    <Layout>
        <section class="mb-3" id="section">
            <CreateTermModal :errors="$page.props.errors" />

            <div v-if="terms" class="container">
                <div class="row">
                    <div class="card bg-light .text-black mb-3 p-2" v-for="(term, index) in terms" :key="term.id">
                        <div class="card-body">
                            <div class="d-lg-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <h3 class="card-title mb-0">
                                        {{ index + 1 }}. {{ term.title }}
                                    </h3>
                                </div>

                                <div v-if="$page.props.isAdmin" class="mb-2 d-flex justify-content-center">
                                    <EditTermModal :term="term" :errors="$page.props.errors" />
                                    <button @click="destroy(term.id)" type="submit"
                                        class="btn btn-danger text-primary mb-3 ms-2" aria-label="Delete Term">
                                        <i class="bi bi-trash h5"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="card-text mb-0 .text-black" aria-label="Term Content">
                                {{ term.content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="terms.length == 0" class="text-center mt-2 h-75" aria-label="No Terms Message">
                <h1>We have no Terms and conditions! :)</h1>
            </div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import CreateTermModal from "./Create.vue";
import EditTermModal from "./Edit.vue";

export default {
    components: {
        Layout,
        EditTermModal,
        CreateTermModal,
        Link,
    },
    props: {
        terms: {
            type: Array,
            required: true,
        },
    },
    setup() {
        const destroy = (id) => {
            if (confirm("Are you sure?")) {
                router.delete(route("terms.delete", id));
            }
        };

        return { destroy };
    },
};
</script>

<style scoped>
#section {
    margin-top: 20px;
}
</style>
