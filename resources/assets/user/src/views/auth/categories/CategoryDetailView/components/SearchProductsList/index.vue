<template>
    <div class="search-list container">
        <ProductBoxesList
            :products="products"
            :productsPagination="productsPagination"
            @clickFavoriteIcon="onClickFavoriteIcon"
            @clickLoadMoreBtn="onClickLoadMoreBtn"
        />
    </div>
</template>

<script src="./SearchProductsList.js"></script>
