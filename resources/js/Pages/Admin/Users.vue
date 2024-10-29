<template>
    <Layout>
        <div class="container">
            <div v-if="$page.props.flash.success" class="alert alert-success">
            {{ $page.props.flash.success }}
        </div>
            <div class="row">
                <div class="col-lg-3">
                    <SideBar aria-label="sidebar navigation" />
                </div>
                <div class="overflow-auto col-md-9 mt-3">
                    <div class="d-flex justify-content-between" aria-label="users list header">
                        <h3>Users List</h3>
                        
                        
                    </div>

                    <table class="table" aria-label="users list table">
                        <thead>
                            <tr>
                                <th aria-label="number column">No.</th>
                                <th aria-label="name column">Name</th>
                                <th aria-label="email column">Email</th>
                                <th aria-label="role column">Role</th>
                                <th aria-label="created at column">Created At</th>
                                <th class="text-end" aria-label="actions column">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="users.data.length === 0">
                                <td colspan="6" aria-label="no users found">No users found.</td>
                            </tr>
                            <tr v-for="(user, index) in users.data" :key="user.id">
                                <td aria-label="user number">{{ index + 1 }}.</td>
                                <td aria-label="user name">{{ user.name }}</td>
                                <td aria-label="user email">{{ user.email }}</td>
                                <td aria-label="user role">{{ user.is_admin }}</td>
                                <td aria-label="user created at">{{ new Date(user.created_at).toLocaleDateString() }}</td>
                                <td class="text-end" aria-label="user actions">
                                    <button 
                                        v-if="user.role !== 'admin'" 
                                        @click="makeAdmin(user.id)" 
                                        class="btn btn-sm btn-info me-1" 
                                        aria-label="make user admin">
                                        Make Admin
                                    </button>
                                    <button class="btn btn-sm btn-warning me-1" aria-label="edit user">Edit</button>
                                    <Button @click="destroy(user.id)" class="btn btn-sm btn-danger"
                                        aria-label="delete user">Delete</Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <Pagination :links="users.links" class="d-flex justify-content-end"
                        aria-label="pagination for users list" />
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
import Layout from "../../Layout/App.vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import SideBar from "./Partials/SideBar.vue";
import Pagination from "./Partials/Pagination.vue";

export default {
    components: {
        Layout,
        Link,
        SideBar,
        Pagination,
    },
    props: {
        users: {
            type: Object, // Assuming users is an object with paginated data
            required: true,
        },
    },
    setup() {
               // Method to make user admin
               const makeAdmin = (id) => {
            if (confirm("Are you sure you want to make this user an admin?")) {
                router.patch(route('users.make-admin', { user: id }));
            }
        };
        const destroy = (id) => {
            if (confirm("Are you sure you want to delete this user?")) {
                router.delete(route("users.destroy", { user: id }));
            }
        };

        return { makeAdmin, destroy };
    },
};
</script>
