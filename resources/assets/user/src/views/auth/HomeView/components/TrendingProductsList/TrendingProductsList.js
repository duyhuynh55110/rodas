import { LOAD_MORE_LIMITED_DEFAULT } from "@/utils/constants";

// components
import { ProductBoxesList, LoadingData, ButtonPrimary } from "@/components";

export default {
    name: "TrendingProductsList",
    components: {
        ProductBoxesList,
        LoadingData,
        ButtonPrimary,
    },
    data() {
        return {
            LOAD_MORE_LIMITED_DEFAULT,
        }
    },
    props: {
        products: {
            type: Object,
            required: true,
        }
    },
    inject: ['onClickFavoriteIcon', 'onClickLoadMoreBtn'],
}
