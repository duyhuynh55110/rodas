// components
import { TitleBar, NotificationBar, PostCardsArea, ItemBoxList, CategorySlidesArea } from "@/components";

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
            trendingItems: [
                {
                    full_path_image: 'https://kede.dexignzone.com/xhtml/img/categories/pic1.jpg',
                    name: 'Brocoli',
                    price: 8.7,
                },
                {
                    full_path_image: 'https://kede.dexignzone.com/xhtml/img/categories/pic2.jpg',
                    name: 'Brocoli',
                    price: 8.7,
                },
                {
                    full_path_image: 'https://kede.dexignzone.com/xhtml/img/categories/pic3.jpg',
                    name: 'Brocoli',
                    price: 8.7,
                },
                {
                    full_path_image: 'https://kede.dexignzone.com/xhtml/img/categories/pic4.jpg',
                    name: 'Brocoli',
                    price: 8.7,
                }
            ],
        }
    }
}
