// Import Swiper components
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Autoplay } from "swiper";

export default {
    name: 'PostsArea',
    components: {
        Swiper,
        SwiperSlide,
    },
    data() {
        return {
            autoplay: {
                delay: 3000,
            },
        }
    },
    setup() {
        return {
          modules: [Pagination, Autoplay],
        };
    },
}
