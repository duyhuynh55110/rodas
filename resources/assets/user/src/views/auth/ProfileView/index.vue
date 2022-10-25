<template>
    <div class="container">
        <Navbar title="Profile" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <a href="#" class="link back">
                    <font-awesome-icon icon="fa-solid fa-arrow-left" />
                </a>
            </template>
        </Navbar>

        <ProfileInfo />
        <ProfileList />
    </div>
</template>
<script src="./ProfileView.js"></script>
