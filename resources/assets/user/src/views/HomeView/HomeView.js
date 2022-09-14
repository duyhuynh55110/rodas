// Import Swiper components
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination } from "swiper";

// components
import { NotificationBar, PostCard } from './components';

export default {
    name: 'HomeView',
    components: {
        Swiper,
        SwiperSlide,
        NotificationBar,
        PostCard
    },
    setup() {
        return {
          modules: [Pagination],
        };
    },
}
