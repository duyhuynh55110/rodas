export default {
    name: "NotificationCard",
    props: {
        notification: {
            type: Object,
            required: true,
        }
    },
    computed: {
        notificationCardClass: function () {
            return {
                'notification-card': true,
                'is-read': this.notification.is_read,
            }
        }
    },
}
