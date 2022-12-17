import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { mapState, useStore } from "vuex";

// components
import ProfileInfo from "./components/ProfileInfo/ProfileInfo.vue";
import ProfileList from "./components/ProfileList/ProfileList.vue";

export default {
    name: "ProfileView",
    components: {
        ProfileInfo,
        ProfileList,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        };
    },
    computed: {
        ...mapState('app', ['auth']),
    },
    setup: async function () {
        const store = useStore();

        // call api
        await store.dispatch('app/loadAuth');

        return {};
    }
}
