<template>
    <Layout>
        <div id="main-div" aria-labelledby="main-heading">
            <h1 id="main-heading" class="text-center">Change Your Data</h1>
            <EditName :user="user" :errors="errors" />
            <EditPhoneNumber :user="user" :errors="errors" />
            <EditEmail :user="user" :errors="errors" />
            <EditAvatar :avatar="user.avatar" :id="user.id" :errors="errors" />
            <EditPassword :user="user" :errors="errors" />
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { Link } from "@inertiajs/vue3";
import EditName from "./Edit/EditName.vue";
import EditEmail from "./Edit/EditEmail.vue";
import EditPhoneNumber from "./Edit/EditPhoneNumber.vue";
import EditAvatar from "./Edit/EditAvatar.vue";
import EditPassword from "./Edit/EditPassword.vue";

export default {
    components: {
        Layout,
        EditName,
        EditEmail,
        EditPhoneNumber,
        EditAvatar,
        EditPassword,
        Link,
    },
    props: {
        errors: Object,
        user: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped>
#main-div {
    margin-top: 140px;
    margin-bottom: 140px;
}
</style>
