// components
import { TitleBar, NotificationBar, GiftBoxCardsArea, ItemBoxList, CategorySlidesArea } from "@/components";
import { mapState } from "vuex";

export default {
    name: 'HomeView',
    components: {
        TitleBar,
        NotificationBar,
        GiftBoxCardsArea,
        CategorySlidesArea,
        ItemBoxList,
    },
    computed: {
        ...mapState('giftBoxes', [
            'giftBoxes',
        ]),
        ...mapState('categories', [
            'categories',
        ]),
        ...mapState('products', [
            'products',
        ]),
        ...mapState('global', [
            'isPageLoading',
        ])
    },
    async created() {
        await this.$store.dispatch('global/loadCompositionHomeView');
        await this.$store.dispatch('products/loadProducts');

        this.$store.commit('global/setIsPageLoading', false);
    }
}
