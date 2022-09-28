import TitleBar from "@/components/ui/TitleBar";
import ButtonPrimary from "@/components/ui/ButtonPrimary";
import ItemBox from "../ItemBox";

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
