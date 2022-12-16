<template>
    <!-- Product boxes -->
    <ProductBoxesList
        :products="products.data"
        :productsPagination="products.pagination"
        :loadMoreLimited="LOAD_MORE_LIMITED_DEFAULT"
        @clickFavoriteIcon="onClickFavoriteIcon"
        @clickLoadMoreBtn="onClickLoadMoreBtn"
    />
</template>

<script src="./TrendingProductsList.js"></script>
