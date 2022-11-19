<template>
    <div>
        <navbar :title="$t('user')" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <div class="container">
            <MenuList />
        </div>
    </div>
</template>

<script src="./UserMenuView.js"></script>
