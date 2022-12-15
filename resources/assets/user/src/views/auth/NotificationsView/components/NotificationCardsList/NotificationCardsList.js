// components
import { PER_PAGE_DEFAULT } from "@/utils/constants"
import NotificationCard from "./components/NotificationCard/NotificationCard.vue"

export default {
    name: "NotificationCardsList",
    inject: ['notifications', 'isLoadingData'],
    components: {
        NotificationCard,
    },
    data() {
        return {
            PER_PAGE_DEFAULT
        }
    }
}
