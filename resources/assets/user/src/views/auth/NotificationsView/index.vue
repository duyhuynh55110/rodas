<template>
    <div class="container">
        <Navbar title="Notifications" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <a href="#" class="link back">
                    <font-awesome-icon icon="fa-solid fa-arrow-left" />
                </a>
            </template>
        </Navbar>

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
