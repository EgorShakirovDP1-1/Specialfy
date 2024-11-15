<template>
    <Layout>
        <div class="profile d-flex mx-auto mb-5">
            <div class="profileImg-navBar text-center rounded me-2 p-3 background" aria-labelledby="profile-nav">
                <img id="avatar" :src="user.avatar" alt="" class="rounded-circle z-1" />
                <ul class="list-unstyled" id="profile-nav">
                    <li class="mb-1 mt-0">
                        <Link :href="route('edit', { user: $page.props.auth })" class="btn btn-dark d-block py-2">
                        <i class="bi bi-person-lines-fill me-2"></i> Edit Profile
                        </Link>
                    </li>
                    <li class="mb-1 mt-0">
                        <Link :href="route('logout')" class="btn btn-dark d-block py-2">
                        <i class="bi bi-box-arrow-right me-2"></i> Log Out
                        </Link>
                    </li>
                    <li class="mb-1 mt-0 ">
                        <MyPosts :myPosts="myPosts" />
                        <likedPosts :likedPosts="likedPosts" />
                    </li>
                    <li class="mb-1 mt-0">
                        <button @click="destroy(user.id)" type="submit" class="btn btn-danger d-block py-2 width-216"
                            aria-label="Delete Account Button">
                            <i class="bi bi-trash-fill me-2"></i> Delete Account
                        </button>
                    </li>
                </ul>
            </div>

            <div class="right-info rounded background mx-2" aria-labelledby="user-info">
                <div class="about rounded p-3">
                    <h3 class="text-center" id="user-info">About You</h3>
                    <ul class="list-group list-group-flush lead">
                        <li>
                            <p class="fw-bold m-0">Name</p>
                            <span>{{ user.name }}</span>
                        </li>
                        <hr class="m-1" />
                        <li>
                            <p class="fw-bold m-0">Email</p>
                            <span>{{ user.email }}</span>
                        </li>
                        <hr class="m-1" />
                        <li>
                            <p class="fw-bold m-0">Phone</p>
                            <span>{{ user.phone_number }}</span>
                        </li>
                        <hr class="m-1" />
                        <li>
                            <p class="fw-bold m-0">Account Created At</p>
                            <span>
                                {{
                                    moment(user.created_at).format("DD-MM-YYYY")
                                }}
                            </span>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
     
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { Link } from "@inertiajs/vue3";
import moment from "moment";
import { router } from "@inertiajs/vue3";
import likedPosts from "./Profile/likedPosts.vue";
import MyPosts from './Profile/myPosts.vue';
export default {
    components: {
        Layout,
        Link,
        likedPosts,
        MyPosts,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
     
        likedPosts: {
            type: Array,
            required: false,
        },
        myPosts: {
            type: Array,
            required: true,
        },
    },
    methods: {
      
    },
    data() {
        return {
            moment: moment,
        };
    },
    setup() {
        const destroy = (id) => {
            if (confirm("Are you sure?")) {
                router.delete(route("delete", id));
            }
        };

        return { destroy };
    },
};
</script>

<style scoped>
#avatar {
    max-height: 240px;
}

.profile {
    width: 60%;
    margin-top: 20px;
}

.profile .right-info {
    width: 100%;
}

.profile .right-info .rent-history {
    height: 420px;
}

.profile .right-info .rent-history .rents .rent p:nth-child(4) {
    background-color: var(--green);
    color: var(--skin);
}

.profile .profileImg-navBar ul,
.profile .right-info .about ul,
.profile .right-info .rent-history ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.profile .profileImg-navBar ul {
    margin-top: 80%;
}

.profile .profileImg-navBar ul li {
    margin: 12px;
}

.profile .profileImg-navBar ul li a {
    position: relative;
    text-decoration-color: var(--white-white);
}

.profile .profileImg-navBar img {
    width: 240px;
}

.profile .right-info .about ul li,
.profile .right-info .rent-history ul li {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
}

.width-216 {
    width: 216px;
}

.background{
    background-color: rgb(230,230,230)

}

</style>
