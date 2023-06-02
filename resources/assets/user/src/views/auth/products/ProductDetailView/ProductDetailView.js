import { Stepper } from "@/components"
import { favoriteService, productService, cartService } from "@/services"
import { useRoute } from "vue-router";
import * as yup from 'yup';

// components
import { Pagination } from "swiper";
import TabSwiper from "./components/TabSwiper/TabSwiper.vue"
import SuccessPopup from "./components/SuccessPopup/SuccessPopup.vue";
import { ADD_TO_CART_TYPE_INSERT } from "@/utils/constants";

// fetch product by id
const fetchProductById = async function (id) {
    const response = await productService.getProductById(id);

    return response;
}

export default {
    name: "ProductDetailView",
    components: {
        Stepper,
        TabSwiper,
        SuccessPopup
    },
    setup: async function () {
        const route = useRoute();
        const id = route.params.id; // product id

        // fetch data
        const { data:dfProduct } = await fetchProductById(id);

        return {
            dfProduct,
            modules: [Pagination],
        }
    },
    data: function () {
        return {
            product: null,
            isProcessFavorite: false,
            isProcessAddToCart: false,
            quantity: 0,
        }
    },
    computed: {
        productSlides: function () {
            return this.product.product_slides ?? [];
        },
        // get product' brand
        brand: function () {
            return this.product.brand;
        },
        // style for thumbnail
        itemThumbnailStyle: function () {
            return {
                'background-image': 'url(' + this.product.image_url + ')',
            }
        },
        // class for wishlist button
        addWishlistBtnClass: function () {
            return {
                "button-large button button-fill add-wishlist-btn": true,
                "active": this.product.is_favorite,
            }
        },
        // total price to buy this item
        amount: function () {
            return this.$helper.amount(this.quantity, this.product.item_price);
        },
    },
    methods: {
        // event on click favorite icon
        onClickAddWishlistBtn: async function () {
            // block click button multiple
            this.isProcessFavorite = true;

            if(!this.product.is_favorite) {
                const { data } = await favoriteService.createFavorite(this.product.id);

                this.product = data;
            } else {
                const { data } = await favoriteService.removeFavorite(this.product.id);

                this.product = data;
            }

            // enable click
            this.isProcessFavorite = false;
        },
        // event on click 'add to cart' button
        onClickAddToCartBtn: async function () {
            // block click button multiple
            this.isProcessAddToCart = true;

            const yupObject = yup.object().shape({
                quantity: yup.number().required().min(1),
            });

            // validate quantity is valid
            await yupObject.validate({ quantity: this.quantity })
            .catch(function(e) {
                alert(e.message);
            });

            // call api add to cart
            await cartService.updateProductQuantity(this.product.id, this.quantity, ADD_TO_CART_TYPE_INSERT);

            this.$vfm.show('successPopup');

            // enable click
            this.isProcessAddToCart = false;
        },
    },
    created() {
        this.product = this.dfProduct;
    }
}
