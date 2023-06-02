import { Stepper } from "@/components"
import { cartService } from "@/services";
import { ADD_TO_CART_TYPE_UPDATE } from "@/utils/constants";

export default {
    name: "CartItem",
    components: {
        Stepper,
    },
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    data: function () {
        return {
            quantity: 0,
            isInitial: true,
        }
    },
    computed: {
        // get product's brand
        brand: function () {
            return this.product.brand;
        },
        amount: function () {
            return this.$helper.amount(this.quantity, this.product.item_price)
        }
    },
    watch: {
        // handle quantity change
        quantity: {
            handler: async function (newValue) {
                // call api update value
                if (!this.isInitial) {
                    await cartService.updateProductQuantity(this.product.id, newValue, ADD_TO_CART_TYPE_UPDATE);
                }
            },
            immediate: false
        }
    },
    mounted: function () {
        this.isInitial = false;
    }
}
