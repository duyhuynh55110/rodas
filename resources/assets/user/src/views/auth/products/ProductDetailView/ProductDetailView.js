import { Stepper } from "@/components"
import { productService } from "@/services"
import { useRoute } from "vue-router";

// components
import { Pagination } from "swiper";
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

        // fetch data
        const { data:product } = await fetchProductById(id);

        return {
            product,
            modules: [Pagination],
        }
    },
    computed: {
        productSlides: function () {
            return this.product.product_slides ?? [];
        },
        brand: function () {
            return this.product.brand;
        },
        itemThumbnailStyle: function () {
            return {
                'background-image': 'url(' + this.product.image_url + ')',
            }
        }
    }
}
