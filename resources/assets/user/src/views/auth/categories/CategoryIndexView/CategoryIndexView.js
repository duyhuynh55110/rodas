import ItemCategoriesList from "./components/ItemCategoriesList";
import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { mapState } from "vuex";
import { resetState } from "@/utils/helper";

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
    created: async function() {
         // start fetching
         this.$store.commit("app/setIsPageLoading", true);

        await this.$store.dispatch('categoryIndexView/loadCategories');

         // end fetching
         this.$store.commit("app/setIsPageLoading", false);
    },
    unmounted: async function () {
        resetState('categoryIndexView');
    }
}
