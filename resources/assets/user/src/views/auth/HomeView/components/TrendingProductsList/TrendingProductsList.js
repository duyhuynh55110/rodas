import { LOAD_MORE_LIMITED_DEFAULT } from "@/utils/constants";
import { mapState } from "vuex";

// components
import { ProductBoxesList, LoadingData, ButtonPrimary } from "@/components";

export default {
    name: "TrendingProductsList",
    components: {
        ProductBoxesList,
        LoadingData,
        ButtonPrimary,
    },
    data() {
        return {
            LOAD_MORE_LIMITED_DEFAULT,
        }
    },
    computed: {
        ...mapState("homeView", [
            "products",
            "productsPagination",
        ]),
    },
    methods: {
        // emit - event click icon on ProductBox
        onClickFavoriteIcon: async function (product) {
            let productId = product.id;

            if(!product.is_favorite) {
                await this.$store.dispatch('homeView/createFavorite', productId);
            } else {
                await this.$store.dispatch('homeView/removeFavorite', productId);
            }
        },
        // emit - event on lick load more data
        onClickLoadMoreBtn: async function (done) {
            await this.$store.dispatch("homeView/loadProducts");

            // callback, product list load completed
            done();
        }
    }
}
