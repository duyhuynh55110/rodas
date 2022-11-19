import { NotificationCard } from "@/components"
import { NAVBAR_STYLE_2 } from "@/utils/constants"


export default {
    name: "NotificationsView",
    components: {
        NotificationCard,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
        }
    }
}
