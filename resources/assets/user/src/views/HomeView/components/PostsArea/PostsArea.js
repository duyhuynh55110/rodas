// Import Swiper components
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination } from "swiper";

export default {
    name: 'PostsArea',
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
          modules: [Pagination],
        };
    },
}
