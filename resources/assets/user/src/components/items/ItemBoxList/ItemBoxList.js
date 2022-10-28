import ButtonPrimary from "@/components/ui/ButtonPrimary";
import ItemBox from "../ItemBox";

export default {
    name: "ItemBoxList",
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
