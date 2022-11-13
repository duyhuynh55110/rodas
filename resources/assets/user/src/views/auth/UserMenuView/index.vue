<template>
    <div>
        <Navbar :title="$t('user')" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <a href="#" class="link back">
                    <font-awesome-icon icon="fa-solid fa-arrow-left" />
                </a>
            </template>
        </Navbar>

        <div class="container">
            <MenuList />
        </div>
    </div>
</template>

<script src="./UserMenuView.js"></script>
