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
                        <input 
                        type="text" 
                        v-model="searchQuery" 
                        @input="filteredUsers" 
                        placeholder="Search by name, ID, or email" 
                        class="form-control w-25"
                        aria-label="user search input"/>    
                    </div>

                    <table class="table" aria-label="users list table">
                        <thead>
                            <tr>
                                <th class="text-center" aria-label="number column">No.</th>
                                <th class="text-center" aria-label="name column">Name</th>
                                <th class="text-center" aria-label="email column">Email</th>
                                <th class="text-center" aria-label="role column">Role</th>
                                <th class="text-center" style="min-width: 150px;" aria-label="created at column">Last login</th>
                                <th class="text-center text-end" aria-label="actions column ">Actions</th>
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
        <td aria-label="user created at">{{ new Date(user.last_login).toLocaleDateString() }}</td>
        <td class="text-end m-5 p-1" aria-label="user actions">
            <div class="d-flex flex-column align-items-center justify-content-center">
                
                <button 
                    v-if="!user.is_admin" 
                    @click="makeAdmin(user.id)" 
                    class="btn btn-sm btn-info me-1 mb-2 fixed-width" 
                    aria-label="make user admin">
                    Make Admin
                </button>

                <button 
                    v-else 
                    @click="deleteAdmin(user.id)" 
                    class="btn btn-sm btn-warning me-1 mb-2 fixed-width" 
                    aria-label="delete admin">
                    Delete Admin
                </button>

                <!-- <button
                    class="btn btn-sm btn-dark me-1 mb-2 fixed-width"
                    aria-label="edit user"
                    @click="edit(user.id)">
                    Edit
                </button> -->

                <!-- <div class="d-flex justify-content-center align-items-center"> -->
                    <!-- <button class="btn btn-sm btn-dark me-1 fixed-width" aria-label="edit user">Edit</button> -->
                    <button 
                        v-if="user.id !== currentUser" 
                        @click="destroy(user.id)" 
                        class="btn btn-sm btn-danger fixed-width" 
                        aria-label="delete user">
                        Delete
                    </button>
                <!-- </div> -->
            </div>
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
import {  ref } from 'vue';
import { debounce } from 'lodash';
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
        currentUser: {
            type: Number,
            required: true,
        },
    },
    setup(props) {
        // Destructure currentUser from props
        const { currentUser } = props;
        const searchQuery = ref("");


        const filteredUsers = debounce(() => {
            router.get(route('admin.users.tables'), { search: searchQuery.value }, {
                preserveState: true,
                replace: true
            });
        }, 300); // Debounce delay in milliseconds

        const makeAdmin = (id) => {
            if (confirm("Are you sure you want to make this user an admin?")) {
                router.patch(route('users.make-admin', { user: id }));
            }
        };

        const deleteAdmin = (id) => {
            if (confirm("Are you sure you want to remove admin privileges from this user?")) {
                router.patch(route('users.remove-admin', { user: id }));
            }
        };

        const destroy = (id) => {
            if (id === props.currentUser) {
                alert("You cannot delete your own account.");
            } else if (confirm("Are you sure you want to delete this user?")) {
                router.delete(route("delete_by_admin", { user: id }));
            }
        };

        const edit = (id) => {
                router.get(route("edit", { user: id }));     
        };

        return { searchQuery, filteredUsers, makeAdmin, deleteAdmin, destroy, edit };
    }
};
</script>


<style>
    .fixed-width {
        width: 80px; /* Adjust this value as needed */
    }

    .fixed-height {
        margin-top: 1rem;
        height: 40px; /* Set a specific height that works well */
         white-space: nowrap; /* Prevent line breaks */
    }
</style>
