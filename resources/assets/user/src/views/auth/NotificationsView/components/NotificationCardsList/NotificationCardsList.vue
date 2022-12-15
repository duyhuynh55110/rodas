<template>
    <div class="notifications-list is-loading" v-if="isLoadingData">
        <NotificationCard v-for="index in PER_PAGE_DEFAULT" :key="index" />
    </div>
    <div class="notifications-list" v-else>
        <NotificationCard
            v-for="notification in notifications.data"
            :key="notification.id"
            :notification="notification" />
    </div>
</template>

<style src="./NotificationCardsList.scss" lang="scss" scoped></style>
<script src="./NotificationCardsList.js"></script>
