<template>
    <div>
        <Navbar title="Wishlist" navbarStyle="2">
            <template v-slot:left>
                <a href="#" class="link back">
                    <font-awesome-icon icon="fa-solid fa-arrow-left" />
                </a>
            </template>
        </Navbar>

        <div class="container">
            <ItemBoxList :items="items" />
        </div>
    </div>
</template>

<script src="./WishListView.js"></script>
