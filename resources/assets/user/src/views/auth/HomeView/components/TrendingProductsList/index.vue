<template>
    <!-- Product boxes -->
    <ProductBoxesList
        :products="products"
        :productsPagination="productsPagination"
        :loadMoreLimited="LOAD_MORE_LIMITED_DEFAULT"
        @clickFavoriteIcon="onClickFavoriteIcon"
        @clickLoadMoreBtn="onClickLoadMoreBtn"
    />
</template>

<script src="./TrendingProductsList.js"></script>
