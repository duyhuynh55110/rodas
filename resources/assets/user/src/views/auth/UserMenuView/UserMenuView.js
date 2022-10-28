import { Navbar, MenuList } from "@/components";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

export default {
    name: "UserMenuView",
    components: {
        Navbar,
        MenuList,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        };
    },
};
