import { categoryService, productService } from "@/services";
import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { nextPage } from "@/utils/helper";
import { setPaginate } from "@/utils/paginator";

// components
import BannerHeading from "./components/BannerHeading/BannerHeading.vue";
import SearchBar from "./components/SearchBar/SearchBar.vue";
import SearchProductsList from "./components/SearchProductsList/SearchProductsList.vue";

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
            products: {},
        };
    },
    setup: async function () {
        const id = this.$route.params.id; // category id
        const search = this.$route.params.search;
        const page = nextPage();

        // fetch data
        const { data: category } = await categoryService.getCategoryById(id);
        const { data, pagination } = await productService.getProducts({
            search,
            category_ids: id,
            page,
        });

        // master data
        return {
            category,
            search,
            dfProducts: setPaginate(data, pagination),
        }
    },
    created: async function () {
        this.products = this.dfProducts;
    },
}
