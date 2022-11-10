// Set up vue
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// Global styles
import "@/scss/main.scss";

// Vuex
import store from "./store";

// FontAwesome
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faBell,
    faArrowRight,
    faHeart,
    faCartShopping,
    faArrowRightArrowLeft,
    faHouse,
    faArrowLeft,
    faCircle,
} from "@fortawesome/free-solid-svg-icons";
import {
    faClock,
} from "@fortawesome/free-regular-svg-icons";

library.add([
    faBell,
    faArrowRight,
    faHeart,
    faCartShopping,
    faArrowRightArrowLeft,
    faHouse,
    faArrowLeft,
    faCircle,
    faClock,
]);

// vue-i18n (translate package)
import i18n from './i18n'

createApp(App)
    .component("font-awesome-icon", FontAwesomeIcon)
    .use(store)
    .use(router)
    .use(i18n)
    .mount("#app");
