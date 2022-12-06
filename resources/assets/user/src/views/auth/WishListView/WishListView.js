import { ProductBoxesList } from "@/components";
import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { mapState } from "vuex";

export default {
    name: "WishListView",
    components: {
        ProductBoxesList,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        };
    },
    computed: {
        ...mapState("app", ["isPageLoading"]),
        ...mapState("wishlistView", ["products", "productsPagination"]),
    },
    methods: {
        // load products list, pagination
        loadProducts: async function () {
            await this.$store.dispatch("wishlistView/loadProducts");
        },
        // emit - event click icon on ProductBox
        onClickFavoriteIcon: async function (product) {
            let productId = product.id;

            if (!product.is_favorite) {
                await this.$store.dispatch(
                    "wishlistView/createFavorite",
                    productId
                );
            } else {
                await this.$store.dispatch(
                    "wishlistView/removeFavorite",
                    productId
                );
            }
        },
        // emit - event on lick load more data
        onClickLoadMoreBtn: async function (done) {
            await this.$store.dispatch("wishlistView/loadProducts");

            // callback, product list load completed
            done();
        },
    },
    async created() {
        // start fetching
        this.$store.commit("app/setIsPageLoading", true);

        // fetching data
        await this.loadProducts();

        // end fetching
        this.$store.commit("app/setIsPageLoading", false);
    },
};
