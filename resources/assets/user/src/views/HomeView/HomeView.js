// components
import { Toolbar } from "@components";
import { NotificationBar, PostsArea, CategoriesArea, TrendingItemsArea } from './components';

export default {
    name: 'HomeView',
    components: {
        Toolbar,
        NotificationBar,
        PostsArea,
        CategoriesArea,
        TrendingItemsArea,
    },
    data() {
        return {
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
