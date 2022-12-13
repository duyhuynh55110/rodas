<template>
    <div class="notifications-list-loading" v-if="isLoadingData">
        isLoading...
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
