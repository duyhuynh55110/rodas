// components
import { TitleBar, NotificationBar, PostCardsArea, ItemBoxList, CategorySlidesArea } from "@/components";
import { mapState } from "vuex";

export default {
    name: 'HomeView',
    components: {
        TitleBar,
        NotificationBar,
        PostCardsArea,
        CategorySlidesArea,
        ItemBoxList,
    },
    data() {
        return {
            posts: [
                {
                    full_path_image: 'https://kede.dexignzone.com/xhtml/img/post/pic1.jpg',
                    title: 'Recommended Recipe Today',
                },
                {
                    full_path_image: 'https://kede.dexignzone.com/xhtml/img/post/pic2.jpg',
                    title: 'Recommended Recipe Today',
                },
                {
                    full_path_image: 'https://kede.dexignzone.com/xhtml/img/post/pic1.jpg',
                    title: 'Recommended Recipe Today',
                },
            ],
        }
    },
    computed: {
        ...mapState('products', [
            'products',
        ])
    },
    created() {
        this.$store.dispatch('products/loadProducts');
    }
}
