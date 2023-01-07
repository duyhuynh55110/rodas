<template>
    <div class="container">
        <navbar title="Profile" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <ProfileInfo :auth="auth" />

        <ProfileList :auth="auth" />
    </div>
</template>
<script src="./ProfileView.js"></script>
