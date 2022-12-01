// components
import {
    TitleBar,
    NotificationBar,
    GiftBoxCardsArea,
    CategorySlidesArea,
    ItemBox,
    ButtonPrimary,
    LoadingData,
} from "@/components";
import { mapState } from "vuex";

// services
import { compositionService } from "@/services";
import { PAGE_DEFAULT, LOAD_MORE_LIMITED_DEFAULT } from "@/utils/constants";

export default {
    name: "HomeView",
    components: {
        TitleBar,
        NotificationBar,
        GiftBoxCardsArea,
        CategorySlidesArea,
        ItemBox,
        ButtonPrimary,
        LoadingData
    },
    data() {
        return {
            giftBoxes: [],
            categories: [],
        };
    },
    computed: {
        ...mapState("homeView", [
            "isLoadingProducts",
            "products",
            "productsPagination",
        ]),
        ...mapState("app", ["isPageLoading"]),
        showLoadMoreBtn: function () {
            // hide on fetching data
            if (this.isLoadingProducts) {
                return false;
            }

            return (
                this.productsPagination.current_page <=
                LOAD_MORE_LIMITED_DEFAULT
            );
        },
    },
    methods: {
        // load master data
        loadCompositionData: async function () {
            const { data } = await compositionService.getHomeViewData();

            this.giftBoxes = data.gift_boxes;
            this.categories = data.categories;
        },
        // load products list with pagination
        // event on click 'load more' button
        loadTrendingItems: async function () {
            let params = {
                page: this.productsPagination?.current_page
                    ? this.productsPagination.current_page + 1
                    : PAGE_DEFAULT,
            };

            await this.$store.dispatch("homeView/loadProducts", params);
        },
        // event on click icon on ItemBox
        onClickFavoriteIcon: async function (product) {
            let productId = product.id;

            if(!product.is_favorite) {
                await this.$store.dispatch('homeView/createFavorite', productId);
            } else {
                await this.$store.dispatch('homeView/removeFavorite', productId);
            }
        }
    },
    async created() {
        // start fetching
        this.$store.commit("app/setIsPageLoading", true);

        // fetching data
        await this.loadCompositionData();
        await this.loadTrendingItems();

        // end fetching
        this.$store.commit("app/setIsPageLoading", false);
    },
};
