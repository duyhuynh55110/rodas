import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { resetState } from "@/utils/helper";
import { mapState } from "vuex";

// components
import BannerHeading from "./components/BannerHeading";
import SearchBar from "./components/SearchBar";
import SearchProductsList from "./components/SearchProductsList";

export default {
    name: "CategoryDetailView",
    components: {
        BannerHeading,
        SearchProductsList,
        SearchBar
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        };
    },
    computed: {
        ...mapState("app", ["isPageLoading"]),
        ...mapState('categoryDetailView', ['category', 'products', 'productsPagination'])
    },
    created: async function () {
        // start fetching
        this.$store.commit("app/setIsPageLoading", true);

        // initial params & query data
        this.$store.commit('categoryDetailView/initialState', {
            id: this.$route.params.id,
            search: this.$route.query.search,
        });

        // fetching data
        await this.$store.dispatch('categoryDetailView/loadCategory');
        await this.$store.dispatch('categoryDetailView/loadProducts');

        // end fetching
        this.$store.commit("app/setIsPageLoading", false);
    },
    unmounted: async function () {
        resetState('categoryDetailView');
    }
}
