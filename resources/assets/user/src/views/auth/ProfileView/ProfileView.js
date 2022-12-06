import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { mapState } from "vuex";

// components
import ProfileInfo from "./components/ProfileInfo";
import ProfileList from "./components/ProfileList";

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
        ...mapState('app', ['isPageLoading', 'auth']),
    },
    created: async function () {
        // start fetching
        this.$store.commit("app/setIsPageLoading", true);

        // fetching data
        await this.$store.dispatch('app/loadAuth');

        // end fetching
        this.$store.commit("app/setIsPageLoading", false);
    },
}
