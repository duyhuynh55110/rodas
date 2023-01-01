// components
import { Stepper } from "@/components"
import { productService } from "@/services"
import { useRoute } from "vue-router";
import TabSwiper from "./components/TabSwiper/TabSwiper.vue"

// fetch product by id
const fetchProductById = async function (id) {
    const response = await productService.getProductById(id);

    return response;
}

export default {
    name: "ProductDetailView",
    components: {
        Stepper,
        TabSwiper
    },
    setup: async function () {
        const route = useRoute();
        const id = route.params.id; // product id

        const { data:product } = await fetchProductById(id);

        return {
            product,
        }
    },
    computed: {
        brand: function () {
            return this.product.brand;
        }
    }
}
