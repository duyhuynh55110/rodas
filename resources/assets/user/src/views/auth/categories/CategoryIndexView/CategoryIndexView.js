import ItemCategoriesList from "./components/ItemCategoriesList";
import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { mapState } from "vuex";

export default {
    name: "CategoriesIndexView",
    components: {
        ItemCategoriesList
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        };
    },
    computed: {
        ...mapState("app", ["isPageLoading"]),
    },
    async created() {
         // start fetching
         this.$store.commit("app/setIsPageLoading", true);

        await this.$store.dispatch('categoryIndexView/loadCategories');

         // end fetching
         this.$store.commit("app/setIsPageLoading", false);
    },
}
