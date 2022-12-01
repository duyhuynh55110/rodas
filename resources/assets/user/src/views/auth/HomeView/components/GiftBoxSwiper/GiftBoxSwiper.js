// Import Swiper components
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination, Autoplay } from "swiper";
import { mapState } from "vuex";

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
    computed: {
        ...mapState('homeView', ['giftBoxes'])
    },
    setup() {
        return {
            modules: [Pagination, Autoplay],
        };
    },
};
