import { cartService } from "@/services";

// components
import CartItem from "./components/CartItem/CartItem.vue"
import { ConfirmPopup } from "@/components"
import LayoutPopup from "@/components/popup/LayoutPopup/LayoutPopup.vue";

// load cart products data
const fetchCartProductsListData = async function () {
    const { data } = await cartService.getCartProducts();

    return data;
};

export default {
    name: "ShoppingsCartView",
    components: {
        CartItem,
        ConfirmPopup,
        LayoutPopup
    },
    data: function () {
        return {
            products: [],
            removeProductId: null,
        }
    },
    setup: async function () {
        // fetching data
        const data = await fetchCartProductsListData();

        // master data & loading list
        return {
            dfProducts: data,
        }
    },
    methods: {
        // event when click confirm button
        onClickConfirmBtn: async function () {
            // call api & remove product
            await cartService.removeProductFromCart(this.removeProductId);
            this.$_.remove(this.products, product => product.id == this.removeProductId);

            // hide confirm popup
            this.$vfm.hide('confirmPopup');
        },
        // show a confirm popup
        showModalRemoveProduct: function (productId) {
            // set remove product id
            this.removeProductId = productId;

            // show confirm popup
            this.$vfm.show('confirmPopup');
        }
    },
    created: function () {
        this.products = this.dfProducts;
    }
}
