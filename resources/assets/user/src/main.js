// Set up vue
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Vuex
import store from './store'

// FontAwesome
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faBell } from "@fortawesome/free-solid-svg-icons";

library.add(faBell);

createApp(App).component("font-awesome-icon", FontAwesomeIcon).use(store).use(router).mount('#app')
