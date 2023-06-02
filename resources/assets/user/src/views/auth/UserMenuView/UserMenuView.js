import { authService } from "@/services";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

// components
import MenuList from "./components/MenuList/MenuList.vue";

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
    provide: function () {
        return {
            onClickLogoutOption: this.onClickLogoutOption,
        }
    },
    methods: {
        // event on click 'Logout' option
        onClickLogoutOption: async function () {
            // logout -> remove token, unset user's data
            await authService.logout();

            this.$router.push({ name: 'login' });
        }
    }
};
