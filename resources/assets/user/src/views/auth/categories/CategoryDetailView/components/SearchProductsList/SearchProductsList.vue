<template>
    <div class="search-list container">
        <ProductBoxesList
            :products="products.data"
            :productsPagination="products.pagination"
            @clickFavoriteIcon="onClickFavoriteIcon"
            @clickLoadMoreBtn="onClickLoadMoreBtn"
        />
    </div>
</template>

<script src="./SearchProductsList.js"></script>
