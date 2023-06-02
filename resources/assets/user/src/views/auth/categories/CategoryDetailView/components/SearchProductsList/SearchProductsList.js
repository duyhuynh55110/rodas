import { ProductBoxesList } from "@/components";

export default {
    name: "SearchProductsList",
    components: {
        ProductBoxesList,
    },
    props: {
        products: {
            type: Object,
            required: true,
        }
    },
    inject: ['onClickFavoriteIcon', 'onClickLoadMoreBtn'],
}
