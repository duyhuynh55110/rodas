export default {
    name: "NotificationCard",
    props: {
        notification: {
            type: Object,
            default: {},
        }
    },
    computed: {
        notificationCardClass: function () {
            return {
                'notification-card': true,
                'is-read': this.notification?.is_read,
            }
        },
        // check this notification is valid data
        // true: show info
        // false: show skeleton
        isLoadingData: function () {
            return this.notification?.id;
        }
    },
}
