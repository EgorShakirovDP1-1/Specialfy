<template>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light border-0 rounded-3 py-3 my-3">
        <ul class="nav nav-pills flex-column d-flex">
            <div class="">
                <li>
                    <Link :href="route('admin')" class="nav-link" :class="{
                        'text-black':
                            !$page.url.includes('/admin/dashboard'),
                        'text-black': $page.url.includes('/admin/dashboard'),
                    }">
                    <i class="bi bi-clipboard text-black me-1"></i>
                    <span>Dashboard</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.users.tables')" class="nav-link" :class="{
                        'text-black':
                            !$page.url.includes('/admin/users'),
                        'text-black': $page.url.includes('/admin/users'),
                    }">
                    <i class="bi bi-people-fill text-black me-1"></i>
                    <span>Users</span>
                    </Link>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle px-3" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-camera-reels-fill text-black me-1"></i>
                            Posts
                        </button>
                        <ul class="dropdown-menu bg-light">
                            <Link :href="route('admin.posts')" class="nav-link ">
                            <span>Table</span>
                            </Link>
                            <Link :href="route('admin.posts.charts')" class="nav-link">
                            <span>Statistics</span>
                            </Link>
                        </ul>
                    </div>
                </li>
                <li>
                    <Link :href="route('terms')" class="nav-link" :class="{
                        'text-black':
                            !$page.url.includes('/admin/terms'),
                        'text-black': $page.url.includes('/admin/terms'),
                    }">
                    <i class="bi bi-file-earmark-ruled text-black me-1"></i>
                    <span>Terms</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.categories')" class="nav-link" :class="{
                        'text-black':
                            !$page.url.includes('/admin/categories'),
                        'text-black': $page.url.includes('/admin/categories'),
                    }">
                    <i class="bi bi-chat-left-dots-fill text-black me-1"></i>
                    <span>Categories</span>
                    </Link>
                </li>
            </div>
        </ul>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
};

</script>

<style scoped>
.dropdown:hover .dropdown-menu {
    display: block;
}
</style>