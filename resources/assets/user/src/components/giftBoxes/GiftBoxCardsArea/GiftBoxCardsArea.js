// Import Swiper components
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination, Autoplay } from "swiper";
import GiftBoxCard from "../GiftBoxCard";

export default {
    name: "GiftBoxCardsArea",
    components: {
        Swiper,
        SwiperSlide,
        GiftBoxCard,
    },
    props: {
        giftBoxes: {
            type: Array,
            default: [],
        }
    },
    data() {
        return {
            autoplay: {
                delay: 3000,
            },
        };
    },
    setup() {
        return {
            modules: [Pagination, Autoplay],
        };
    },
};
