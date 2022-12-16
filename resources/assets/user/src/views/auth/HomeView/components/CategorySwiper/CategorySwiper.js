// Import Swiper components
import { Swiper, SwiperSlide } from 'swiper/vue';

export default {
    name: "CategorySwiper",
    components: {
        Swiper,
        SwiperSlide,
    },
    props: {
        categories: {
            type: Array,
            required: true,
        }
    },
}
