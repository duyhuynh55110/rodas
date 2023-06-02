// components
import { Swiper, SwiperSlide } from 'swiper/vue';

export default {
    name: "TabSwiper",
    components: {
        Swiper,
        SwiperSlide
    },
    data: function () {
        return {
            activeIndex: 0,
            swiper: null,
            tabButtons: [
                {
                    index: 0,
                    text: this.$t('description')
                },
                {
                    index: 1,
                    text: this.$t('review')
                },
                {
                    index: 2,
                    text: this.$t('discussion')
                },
            ]
        }
    },
    props: {
        product: {
            type: Object,
            required: true,
        }
    },
    methods: {
        // event when initial swiper
        onSwiper: function (swiper) {
            this.swiper = swiper;
        },
        // event on change slide on tab swiper
        onSlideChange: function (swiper) {
            this.activeIndex = swiper.activeIndex;
        },
        // event on click tab button
        onClickTabButton: function (index) {
            this.swiper.slideTo(index);
        },
        // style for tab button
        tabLinkClass: function (index) {
            return {
                'tab-link': true,
                'tab-link-active': this.activeIndex == index,
            }
        },
    }
}
