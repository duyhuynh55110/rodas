import { NAVBAR_STYLE_1, NAVBAR_STYLE_2 } from '@/utils/constants'

export default {
    name: "Navbar",
    props: {
        title: {
            type: String,
            required: true,
        },
        navbarStyle: {
            type: Number,
            default: NAVBAR_STYLE_1,
        }
    },
    computed: {
        hasLeftSlot: function () {
            return !!this.$slots.left;
        },
        navbarClass: function () {
            return {
                'navbar': true,
                'navbar-style-1': this.navbarStyle == NAVBAR_STYLE_1,
                'navbar-style-2': this.navbarStyle == NAVBAR_STYLE_2,
            };
        }
    }
}
