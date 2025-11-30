import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "@/plugins/router";

// Add this import for Iconify:
import { Icon } from '@iconify/vue'

// Importing Bootstrap and other global CSS files
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

// Your other CSS files
import '@css/style.css'
import '@css/remixicon.css'

const app = createApp(App);
app.component('iconify-icon', Icon)
app.use(createPinia());
app.use(router);

app.mount("#app");