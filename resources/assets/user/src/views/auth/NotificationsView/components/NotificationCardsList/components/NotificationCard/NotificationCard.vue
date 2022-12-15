<template>
    <div :class="notificationCardClass">
        <!-- Title -->
        <div class="item-title" v-if="isLoadingData">
            <font-awesome-icon icon="fa-solid fa-circle" class="text-primary" />
            {{ notification.title }}
        </div>
        <skeletor class="item-title" v-else />

        <!-- Text -->
        <div class="item-text" v-if="isLoadingData"> {{ notification.content }} </div>
        <skeletor class="item-text" v-else />

        <div class="item-time">
            <span v-if="isLoadingData">
                <font-awesome-icon icon="fa-regular fa-clock" />
                {{ notification.created_human_date }}
            </span>
            <skeletor as="span" v-else />
        </div>
    </div>
</template>
<script src="./NotificationCard.js"></script>
<style src="./NotificationCard.scss" lang="scss" scoped></style>
