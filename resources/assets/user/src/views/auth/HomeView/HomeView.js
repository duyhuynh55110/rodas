// components
import { TitleBar, NotificationBar } from "@/components";
import CategorySwiper from "./components/CategorySwiper";
import GiftBoxSwiper from "./components/GiftBoxSwiper";
import TrendingProductsList from "./components/TrendingProductsList";

// store
import { mapState } from "vuex";

export default {
    name: "HomeView",
    components: {
        TitleBar,
        NotificationBar,
        GiftBoxSwiper,
        CategorySwiper,
        TrendingProductsList,
    },
    computed: {
        ...mapState("app", ["isPageLoading"]),
        ...mapState("homeView", ["productsPagination"])
    },
    methods: {
        // load master data
        loadCompositionData: async function () {
            await this.$store.dispatch("homeView/loadCompositionData");
        },
        // load products list with pagination
        // event on click 'load more' button
        loadTrendingProducts: async function () {
            await this.$store.dispatch("homeView/loadProducts");
        },
    },
    async created() {
        // start fetching
        this.$store.commit("app/setIsPageLoading", true);

        // fetching data
        await this.loadCompositionData();
        await this.loadTrendingProducts();

        // end fetching
        this.$store.commit("app/setIsPageLoading", false);
    },
};
