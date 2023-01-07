import { Pagination, Autoplay } from "swiper";

export default {
    name: "GiftBoxSwiper",
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
