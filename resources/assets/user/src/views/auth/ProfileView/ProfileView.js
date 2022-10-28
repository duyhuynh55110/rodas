import { Navbar, ProfileInfo, ProfileList } from "@/components";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

export default {
    name: "ProfileView",
    components: {
        Navbar,
        ProfileInfo,
        ProfileList,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        };
    },
}
