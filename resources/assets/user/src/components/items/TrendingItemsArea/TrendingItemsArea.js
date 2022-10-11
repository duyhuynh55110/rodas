import ButtonPrimary from "@/components/ui/ButtonPrimary";
import ItemBox from "../ItemBox";

export default {
    name: "TrendingItemsArea",
    components: {
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
