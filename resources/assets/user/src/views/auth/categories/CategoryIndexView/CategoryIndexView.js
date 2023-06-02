import ItemCategoriesList from "./components/ItemCategoriesList/ItemCategoriesList.vue";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

// services
import { categoryService } from "@/services";

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
    setup: async function() {
        const { data } = await categoryService.getCategories();

        return {
            categories: data
        }
    }
}
