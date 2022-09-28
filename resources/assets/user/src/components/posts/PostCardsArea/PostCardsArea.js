// Import Swiper components
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination, Autoplay } from "swiper";
import PostCard from "../PostCard";

export default {
    name: "PostCards",
    components: {
        Swiper,
        SwiperSlide,
        PostCard,
    },
    props: {
        posts: {
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
