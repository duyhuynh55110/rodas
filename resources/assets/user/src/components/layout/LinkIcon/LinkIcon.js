import { IconBack, IconMenu } from "./components"

export default {
    name: "LinkIcon",
    components: {
        IconBack,
        IconMenu,
    },
    props: {
        linkIcon: {
            type: String,
            required: true,
        }
    },
}
