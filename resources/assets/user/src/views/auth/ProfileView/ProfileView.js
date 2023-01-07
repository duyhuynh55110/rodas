import { authService } from "@/services";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

// components
import ProfileInfo from "./components/ProfileInfo/ProfileInfo.vue";
import ProfileList from "./components/ProfileList/ProfileList.vue";


// fetch user's profile
const fetchUserProfile = async function () {
    // call api
    const response = await authService.getUserProfile();

    return response;
};

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
    setup: async function () {
        const { data } = await fetchUserProfile();

        return {
            auth: data,
        };
    }
}
