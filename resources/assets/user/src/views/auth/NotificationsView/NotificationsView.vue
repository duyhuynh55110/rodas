<template>
    <div class="container">
        <navbar title="Notifications" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <!-- filter buttons -->
        <FilterCondition />

        <!-- notifications list -->
        <NotificationCardsList :notifications="notifications" />
    </div>
</template>
<script src="./NotificationsView.js"></script>
