<template>
    <screen-loading v-if="isPageLoading" />
    <div class="container" v-else>
        <navbar title="Profile" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <ProfileInfo />
        <ProfileList />
    </div>
</template>
<script src="./ProfileView.js"></script>
