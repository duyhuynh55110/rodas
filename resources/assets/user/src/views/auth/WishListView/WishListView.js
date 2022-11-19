import { ItemBoxList } from "@/components";
import { NAVBAR_STYLE_2 } from "@/utils/constants";

export default {
    name: "CartView",
    components: {
        ItemBoxList,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
            items: [
                {
                    full_path_image:
                        "https://kede.dexignzone.com/xhtml/img/categories/pic1.jpg",
                    name: "Brocoli",
                    price: 8.7,
                },
                {
                    full_path_image:
                        "https://kede.dexignzone.com/xhtml/img/categories/pic2.jpg",
                    name: "Brocoli",
                    price: 8.7,
                },
                {
                    full_path_image:
                        "https://kede.dexignzone.com/xhtml/img/categories/pic6.jpg",
                    name: "Brocoli",
                    price: 8.7,
                },
                {
                    full_path_image:
                        "https://kede.dexignzone.com/xhtml/img/categories/pic4.jpg",
                    name: "Brocoli",
                    price: 8.7,
                },
            ],
        };
    },
};
