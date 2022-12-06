<template>
    <screen-loading v-if="isPageLoading" />
    <div v-else>
        <navbar :title="$t('wishlist')" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <div class="container">
            <!-- Product boxes -->
            <ProductBoxesList
                :products="products"
                :productsPagination="productsPagination"
                @clickFavoriteIcon="onClickFavoriteIcon"
                @clickLoadMoreBtn="onClickLoadMoreBtn"
            />
        </div>
    </div>
</template>

<script src="./WishListView.js"></script>
