import { NAVBAR_STYLE_2 } from "@/utils/constants";

// components
import MenuList from "./components/MenuList";

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
