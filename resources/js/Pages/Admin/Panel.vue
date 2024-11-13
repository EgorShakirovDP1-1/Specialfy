<template>
    <Layout>
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <SideBar aria-label="sidebar navigation" />
                </div>
                
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="row g-2"> <!-- Changed from g-1 to g-2 for slightly larger gaps -->
                        <!-- First Row -->
                        <div class="col-md-6 px-2"> <!-- Changed from px-1 to px-2 for slightly larger padding -->
                            <div class="panel-wrapper h-100">
                                <UsersCount :users="users" class="panel-element" aria-label="users count" />
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="panel-wrapper h-100">
                                <AdminsCount :admins="admins" class="panel-element" aria-label="admins count" />
                            </div>
                        </div>
                        
                        <!-- Second Row -->
                        <div class="col-md-6 px-2">
                            <div class="panel-wrapper h-100">
                                <PostsCount :posts="posts" class="panel-element" aria-label="posts count" />
                            </div>
                        </div>
                        <div class="col-md-6 px-2">
                            <div class="panel-wrapper h-100">
                                <TermsCount :terms="terms" class="panel-element" aria-label="terms count" />
                            </div>
                        </div>
                        
                        <!-- Third Row -->
                        <div class="col-md-6 px-2">
                            <div class="panel-wrapper h-100">
                                <CommentsCount :comments="comments" class="panel-element" aria-label="comments count" />
                            </div>
                        </div>
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
import PostsCount from "./Partials/PostsCount.vue";
import AdminsCount from './Partials/AdminsCount.vue';
import TermsCount from './Partials/TermsCount.vue';
import CommentsCount from './Partials/CommentsCount.vue';

export default {
    components: {
        Layout,
        Link,
        SideBar,
        UsersCount,
        PostsCount,
        AdminsCount,
        TermsCount,
        CommentsCount,
    },
    props: {
        users: {
            type: Number,
            required: true,
        },
        posts: {
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

<style scoped>
.panel-wrapper {
    height: 100%;
    width: 100%;
}

.panel-wrapper :deep(.panel) {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 0.1rem 0; /* Reduced vertical margin */
}
.panel-element {
    width: 100%;
    max-height: 180px;
    padding: 10px !important;
}


</style>