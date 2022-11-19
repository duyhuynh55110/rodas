<template>
    <div class="container">
        <navbar title="Notifications" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <div class="notifications-list">
            <NotificationCard />
            <NotificationCard />
            <NotificationCard />
            <NotificationCard />
            <NotificationCard />
            <NotificationCard />
            <NotificationCard />
            <NotificationCard />
            <NotificationCard />
        </div>
    </div>
</template>
<script src="./NotificationsView.js"></script>
