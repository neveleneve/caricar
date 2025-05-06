import { createApp } from "vue";
import axios from "axios";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
import "@/app.css";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import VueEasyLightbox from "vue-easy-lightbox";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";
import { createPinia } from "pinia";
import "@material-design-icons/font";
import App from "@/components/App.vue";
import router from "@/router";
import VueApexCharts from "vue3-apexcharts";

axios.defaults.baseURL = "/";
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axios.defaults.headers.common["Accept"] = "application/json";

try {
    const token = storage.getItem(STORAGE_KEYS.TOKEN);
    if (token && typeof token === "string") {
        axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    }
} catch (error) {
    console.error("Error accessing token:", error);             
}

const style = document.createElement("style");
style.textContent = `
    body, #app, html {
        transition: background-color 300ms ease-in-out,
                    border-color 300ms ease-in-out,
                    color 300ms ease-in-out;
    }

    .transform-transition {
        transition: transform 300ms cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
    }
`;
document.head.appendChild(style);

const app = createApp(App);
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

app.use(router);
app.use(pinia);
app.use(VueSweetalert2);
app.use(VueEasyLightbox);
app.use(VueApexCharts);
app.mount("#app");
