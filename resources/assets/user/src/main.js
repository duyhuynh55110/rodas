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
    faBars,
    faMagnifyingGlass,
} from "@fortawesome/free-solid-svg-icons";
import { faClock } from "@fortawesome/free-regular-svg-icons";

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
    faBars,
    faMagnifyingGlass,
]);

// vue-i18n (translate package)
import i18n from "./i18n";

// global components
import { Navbar, LinkIcon } from "@/components";

// initial app
const app = createApp(App);

// https://vuejs.org/guide/components/provide-inject.html#working-with-reactivity
app.config.unwrapInjectedRef = true;

// add global components & global object to App
app.component("font-awesome-icon", FontAwesomeIcon)
    .component("navbar", Navbar)
    .component("link-icon", LinkIcon)
    .use(store)
    .use(router)
    .use(i18n)
    .mount("#app");
