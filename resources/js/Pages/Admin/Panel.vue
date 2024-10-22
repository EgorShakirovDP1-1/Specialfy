<template>
    <Layout>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <SideBar aria-label="sidebar navigation" />
                </div>
                <div class="col-lg-9">
                    <div class="row my-3">
                        <UsersCount :users="users" aria-label="users count" />
                        <AdminsCount :admins="admins" aria-label="admins count" />
                    </div>
                    <div class="row">
                        <FilmsCount :films="films" aria-label="films count" />
                        <TermsCount :terms="terms" aria-label="terms count" />
                    </div>
                    <div class="row my-3">
                        <CommentsCount :comments="comments" aria-label="comments count" />
                       
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { Link } from "@inertiajs/vue3";
import SideBar from "./Partials/SideBar.vue";
import UsersCount from "./Partials/UsersCount.vue";
import FilmsCount from "./Partials/FilmsCount.vue";
import AdminsCount from './Partials/AdminsCount.vue';
import TermsCount from './Partials/TermsCount.vue';
import CommentsCount from './Partials/CommentsCount.vue'


export default {
    components: {
        Layout,
        Link,
        SideBar,
        UsersCount,
        FilmsCount,
        AdminsCount,
        TermsCount,
        CommentsCount,
        
    },
    props: {
        users: {
            type: Number,
            required: true,
        },
        films: {
            type: Number,
            required: true,
        },
        admins: {
            type: Number,
            required: true,
        },
        terms: {
            type: Number,
            required: true,
        },
        comments: {
            type: Number,
            required: true,
        },
      
    },
};

</script>

<style></style>