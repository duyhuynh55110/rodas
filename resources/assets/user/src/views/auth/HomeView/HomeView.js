// components
import { TitleBar, NotificationBar, GiftBoxCardsArea, ItemBoxList, CategorySlidesArea } from "@/components";
import { mapState } from "vuex";

// services
import { compositionService } from "@/services";

export default {
    name: 'HomeView',
    components: {
        TitleBar,
        NotificationBar,
        GiftBoxCardsArea,
        CategorySlidesArea,
        ItemBoxList,
    },
    data() {
        return {
            giftBoxes: [],
            categories: [],
        };
    },
    computed: {
        ...mapState('products', [
            'products',
            'productsPagination',
        ]),
        ...mapState('global', [
            'isPageLoading',
        ]),
    },
    async created() {
        // start fetching
        this.$store.commit('global/setIsPageLoading', true);

        // fetching data
        await this.loadCompositionData();
        await this.loadTrendingItems();

        // end fetching
        this.$store.commit('global/setIsPageLoading', false);
    },
    methods: {
        // load master data
        loadCompositionData: async function () {
            const { data } = await compositionService.getHomeViewData();

            this.giftBoxes = data.gift_boxes;
            this.categories = data.categories;
        },
        // load products list with pagination
        loadTrendingItems: async function () {
            await this.$store.dispatch('products/loadProducts');
        }
    }
}
