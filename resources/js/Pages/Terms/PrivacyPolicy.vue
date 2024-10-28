<template>
    <Layout>
        <section class="mb-3 mx-3 border border-light" id="section">
            <p class="text-center text-black header">
                Privacy Policy
            </p>
            <div class="rounded text-black mb-3 mx-5 p-4 maintext">
                <h4>Privacy Policy for Specialfy</h4>
                At Specialfy, accessible at www.specialfy.com, the privacy of our visitors is one of our main priorities. This Privacy Policy document contains types of information that is collected and recorded by Specialfy and how we use it.
                <br><br>

                <h5>1. Information Collection and Use</h5>
                We collect personal information when you voluntarily provide it to us. This may include your name, email address, phone number, payment information, and any other details necessary to provide our services. We use this information to process orders, improve our services, and communicate with you.
                <br><br>

                <h5>2. Log Data</h5>
                When you access our website, we collect information that your browser sends, which is referred to as Log Data. This data may include your computer’s IP address, browser type, browser version, the pages of our site that you visit, the time and date of your visit, the time spent on those pages, and other relevant statistics. This information helps us to analyze trends and manage the website.
                <br><br>

                <h5>3. Cookies</h5>
                Specialfy uses cookies to enhance user experience. Cookies are files with a small amount of data sent to your browser from a website and stored on your device. We use these cookies to collect information to improve our services, save your preferences, and understand your interaction with the site. You may disable cookies in your browser settings, but this may limit your experience on the website.
                <br><br>

                <h5>4. Third-Party Services</h5>
                We may employ third-party companies and individuals to facilitate our service. These third parties have access to your personal information only to perform tasks on our behalf and are obligated not to disclose or use it for any other purpose. Examples include payment processors and email marketing platforms.
                <br><br>

                <h5>5. Data Security</h5>
                Specialfy takes your data privacy seriously. We implement reasonable security measures to protect your information from unauthorized access, alteration, or destruction. However, please be aware that no method of transmission over the internet or electronic storage is 100% secure.
                <br><br>

                <h5>6. Links to Other Sites</h5>
                Our website may contain links to external sites that are not operated by us. We advise you to review the privacy policies of these third-party sites, as we hold no responsibility for their content, privacy policies, or practices.
                <br><br>

                <h5>7. Changes to This Privacy Policy</h5>
                We may update our Privacy Policy from time to time. You are encouraged to review this page periodically for any changes. Changes are effective immediately after they are posted on this page.
                <br><br>

                <h5>8. Contact Us</h5>
                If you have any questions about this Privacy Policy, please contact us at info@specialfy.com.
            </div>
        </section>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import CreateTermModal from "./Create.vue";
import EditTermModal from "./Edit.vue";

export default {
    components: {
        Layout,
        EditTermModal,
        CreateTermModal,
        Link,
    },
    props: {
        terms: {
            type: Array,
            required: true,
        },
    },
   
};
</script>

<style scoped>
#section {
    margin-top: 20px;
}

.header {
    font-size: xx-large;
}

.maintext{
    line-height: 1.6;
    font-size: 1rem;
    background-color: rgb(230,230,230);
}
</style>
