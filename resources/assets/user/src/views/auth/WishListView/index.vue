<template>
    <div>
        <navbar :title="$t('wishlist')" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <div class="container">
            <ItemBoxList :items="items" />
        </div>
    </div>
</template>

<script src="./WishListView.js"></script>
