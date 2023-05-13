import { NAVBAR_STYLE_1, NAVBAR_STYLE_2 } from '@/utils/constants'

export default {
    name: "Navbar",
    props: {
        title: {
            type: String,
            required: false,
            default: '',
        },
        navbarStyle: {
            type: Number,
            default: NAVBAR_STYLE_1,
        },
        navbarTransparent: {
            type: Boolean,
            default: false,
        }
    },
    computed: {
        // check user has use left slot
        hasLeftSlot: function () {
            return !!this.$slots.left;
        },
        // navbar's class
        navbarClass: function () {
            return {
                'navbar': true,
                'text-capitalize': true,
                'navbar-transparent': this.navbarTransparent,
                'navbar-style-1': this.navbarStyle == NAVBAR_STYLE_1,
                'navbar-style-2': this.navbarStyle == NAVBAR_STYLE_2,
            };
        }
    }
}
