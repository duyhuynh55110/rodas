// Import Swiper components
import { Swiper, SwiperSlide } from 'swiper/vue';
import { mapState } from 'vuex';

export default {
    name: "CategorySwiper",
    components: {
        Swiper,
        SwiperSlide,
    },
    computed: {
        ...mapState('homeView', ['categories'])
    }
}
