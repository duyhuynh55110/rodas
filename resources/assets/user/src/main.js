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
import { faBell, faArrowRight, faHeart, faCartShopping, faArrowRightArrowLeft, faHouse, faArrowLeft, faCircle, faBars, faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
import { faClock } from "@fortawesome/free-regular-svg-icons";

library.add([ faBell, faArrowRight, faHeart, faCartShopping, faArrowRightArrowLeft, faHouse, faArrowLeft, faCircle, faClock, faBars, faMagnifyingGlass]);

// vue-i18n (translate package)
import i18n from "./i18n";

// vue-skeletor
import { Skeletor } from 'vue-skeletor';

// swiper.js
import { Swiper, SwiperSlide } from "swiper/vue";

// global components, objects
import { Navbar, LinkIcon, Toolbar } from "@/components";
import * as helper from "@/utils/helper";
import * as auth from "@/utils/auth";

// initial app
const app = createApp(App);

// https://vuejs.org/guide/components/provide-inject.html#working-with-reactivity
app.config.unwrapInjectedRef = true;

// global properties (object, functions...)
app.config.globalProperties.$helper = helper;
app.config.globalProperties.$auth = auth;

// add global components & global object to App
app.component("font-awesome-icon", FontAwesomeIcon)
    .component("navbar", Navbar)
    .component("Toolbar", Toolbar)
    .component("link-icon", LinkIcon)
    .component("skeletor", Skeletor)
    .component("swiper", Swiper)
    .component("swiper-slide", SwiperSlide)
    .use(store)
    .use(router)
    .use(i18n)
    .use(helper)
    .mount("#app");
