import { Navbar, ItemCategoriesList } from "@/components";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

export default {
    name: 'CategoriesView',
    components: {
        Navbar,
        ItemCategoriesList
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
            categories: [
                {
                    id: 1,
                    full_path_image: "https://kede.dexignzone.com/xhtml/img/svg/grapes.svg",
                    name: "Grapes",
                },
                {
                    id: 2,
                    full_path_image: "https://kede.dexignzone.com/xhtml/img/svg/leaf.svg",
                    name: "Leaf",
                },
            ],
        };
    },
}
