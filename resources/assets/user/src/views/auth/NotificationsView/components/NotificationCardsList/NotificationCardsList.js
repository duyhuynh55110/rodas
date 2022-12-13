// components
import NotificationCard from "./components/NotificationCard"

export default {
    name: "NotificationCardsList",
    inject: ['notifications', 'isLoadingData'],
    components: {
        NotificationCard,
    },
}
