<template>
    <Layout>aboba</Layout>
    
</template>
<script>import Layout from "../../Layout/App.vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import CreateTermModal from "./Create.vue";
import EditTermModal from "./Edit.vue";
export default {
    components: {
        Layout,
      
        Link,
    }}
</script>