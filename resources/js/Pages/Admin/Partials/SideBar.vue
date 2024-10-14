<template>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-black border-0 rounded-3 py-3 my-3">
        <ul class="nav nav-pills flex-column d-flex">
            <div class="">
                <li>
                    <Link :href="route('admin')" class="nav-link" :class="{
                        'text-secondary':
                            !$page.url.includes('/admin/dashboard'),
                        'text-white': $page.url.includes('/admin/dashboard'),
                    }">
                    <i class="bi bi-clipboard text-white me-1"></i>
                    <span>Dashboard</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.users.tables')" class="nav-link" :class="{
                        'text-secondary':
                            !$page.url.includes('/admin/users'),
                        'text-black': $page.url.includes('/admin/users'),
                    }">
                    <i class="bi bi-people-fill text-danger me-1"></i>
                    <span>Users</span>
                    </Link>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle px-3" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-camera-reels-fill text-white me-1"></i>
                            Films
                        </button>
                        <ul class="dropdown-menu bg-light">
                            <Link :href="route('admin.films')" class="nav-link text-black">
                            <span>Table</span>
                            </Link>
                            <Link :href="route('admin.films.charts')" class="nav-link text-white">
                            <span>Statistics</span>
                            </Link>
                        </ul>
                    </div>
                </li>
                <li>
                    <Link :href="route('admin')" class="nav-link" :class="{
                        'text-secondary':
                            !$page.url.includes('/admin/terms'),
                        'text-white': $page.url.includes('/admin/terms'),
                    }">
                    <i class="bi bi-file-earmark-ruled text-white me-1"></i>
                    <span>Terms</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin')" class="nav-link" :class="{
                        'text-secondary':
                            !$page.url.includes('/admin/comments'),
                        'text-white': $page.url.includes('/admin/comments'),
                    }">
                    <i class="bi bi-chat-left-dots-fill text-white me-1"></i>
                    <span>Comments</span>
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