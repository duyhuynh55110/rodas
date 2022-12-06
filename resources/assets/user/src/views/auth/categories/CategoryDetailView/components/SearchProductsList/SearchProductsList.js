import { ProductBoxesList } from "@/components";
import { mapState } from "vuex";

export default {
    name: "SearchProductsList",
    components: {
        ProductBoxesList,
    },
    computed: {
        ...mapState('categoryDetailView', ['products', 'productsPagination'])
    },
    methods: {
        // emit - event click icon on ProductBox
        onClickFavoriteIcon: async function (product) {
            let productId = product.id;

            if(!product.is_favorite) {
                await this.$store.dispatch('categoryDetailView/createFavorite', productId);
            } else {
                await this.$store.dispatch('categoryDetailView/removeFavorite', productId);
            }
        },
        // emit - event on lick load more data
        onClickLoadMoreBtn: async function (done) {
            await this.$store.dispatch("categoryDetailView/loadProducts");

            // callback, product list load completed
            done();
        }
    }
}
