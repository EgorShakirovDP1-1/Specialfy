<template>
    <Layout>
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <SideBar aria-label="sidebar navigation" />
          </div>
          <div class="col-lg-9">
            <div class="row my-3">
              <UsersCount :users="users" aria-label="users count" class="" />
              <AdminsCount :admins="admins" aria-label="admins count" class="" />
            </div>
            <div class="row my-3">
              <PostsCount :posts="posts" aria-label="posts count" class="" />
              <TermsCount :terms="terms" aria-label="terms count" class="" />
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
  import PostsCount from "./Partials/PostsCount.vue";
  import AdminsCount from './Partials/AdminsCount.vue';
  import TermsCount from './Partials/TermsCount.vue';
  import CommentsCount from './Partials/CommentsCount.vue'
  
  
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
  .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .col-lg-3, .col-lg-4, .col-lg-6, .col-lg-12 {
    flex: 1;
  }

  </style>