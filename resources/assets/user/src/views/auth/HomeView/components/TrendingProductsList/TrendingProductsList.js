import { LOAD_MORE_LIMITED_DEFAULT } from "@/utils/constants";
import { mapState } from "vuex";

// components
import { ProductBox, LoadingData, ButtonPrimary } from "@/components";

export default {
    name: "TrendingProductsList",
    components: {
        ProductBox,
        LoadingData,
        ButtonPrimary,
    },
    computed: {
        ...mapState("homeView", [
            "isLoadingProducts",
            "products",
            "productsPagination",
        ]),
        showLoadMoreBtn: function () {
            // hide on fetching data
            if (this.isLoadingProducts) {
                return false;
            }

            // hide if large than load more limited
            return this.productsPagination.current_page <= LOAD_MORE_LIMITED_DEFAULT;
        },
    },
    methods: {
        // event click icon on ProductBox
        onClickFavoriteIcon: async function (product) {
            let productId = product.id;

            if(!product.is_favorite) {
                await this.$store.dispatch('homeView/createFavorite', productId);
            } else {
                await this.$store.dispatch('homeView/removeFavorite', productId);
            }
        },
        // emit - event on lick load more data
        onClickLoadMoreBtn: async function () {
            await this.$store.dispatch("homeView/loadProducts");
        }
    }
}
