import { MenuList } from "@/components";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

export default {
    name: "UserMenuView",
    components: {
        MenuList,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        };
    },
};
