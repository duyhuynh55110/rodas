// components
import { PER_PAGE_DEFAULT } from "@/utils/constants"
import NotificationCard from "./components/NotificationCard/NotificationCard.vue"

export default {
    name: "NotificationCardsList",
    components: {
        NotificationCard,
    },
    props: {
        notifications: {
            type: Object,
            required: true,
        }
    },
    inject: ['isLoadingData'],
    data() {
        return {
            PER_PAGE_DEFAULT
        }
    }
}
