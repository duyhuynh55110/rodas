import { TitleBar, ButtonPrimary, ItemBox } from "@components";

export default {
    name: "TrendingItemsArea",
    components: {
        TitleBar,
        ButtonPrimary,
        ItemBox,
    },
    props: {
        items: {
            type: Array,
            default: [],
        }
    }
}
