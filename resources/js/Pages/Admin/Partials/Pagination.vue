<template>
    <div class="" v-if="!links">No pagination</div>
    <div v-else="links.length > 3">
        <ul class="pagination">
            <li v-for="(link, key) in links" :key="key" class="page-item" :class="{ 'active': link.active }">
                <Link v-if="link.url" :href="link.url" class="page-link" v-html="link.label">
                </Link>
                <span v-else class="page-link" v-html="link.label"></span>
            </li>
        </ul>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link,
    },
    props: {
        links: {
            type: Object,
            required: true,
        },
    },
}
</script>