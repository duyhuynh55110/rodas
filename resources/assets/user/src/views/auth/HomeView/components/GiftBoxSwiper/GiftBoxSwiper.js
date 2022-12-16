// Import Swiper components
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination, Autoplay } from "swiper";

export default {
    name: "GiftBoxSwiper",
    components: {
        Swiper,
        SwiperSlide,
    },
    data() {
        return {
            autoplay: {
                delay: 3000,
            },
        };
    },
    props: {
        giftBoxes: {
            type: Array,
            required: true,
        }
    },
    setup() {
        return {
            modules: [Pagination, Autoplay],
        };
    },
};
