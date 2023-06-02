<template>
    <div>
        <navbar :title="$t('wishlist')" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <div class="container">
            <!-- Product boxes -->
            <ProductBoxesList
                :products="products.data"
                :productsPagination="products.pagination"
                @clickFavoriteIcon="onClickFavoriteIcon"
                @clickLoadMoreBtn="onClickLoadMoreBtn"
            />
        </div>
    </div>
</template>

<script src="./WishListView.js"></script>
