<template>
    <div class="row">
        <!-- Product boxes -->
        <div class="col-50" v-for="product in products" :key="product.id">
            <ProductBox
                :product="product"
                @clickFavoriteIcon="onClickFavoriteIcon(product)"
            />
        </div>

        <!-- Load more button -->
        <div class="col-100">
            <ButtonPrimary
                v-if="showLoadMoreBtn"
                :content="$t('load more')"
                customClass="text-capitalize"
                @clickButton="onClickLoadMoreBtn"
            />
            <div v-if="isLoadingProducts" class="loading-products">
                <LoadingData />
            </div>
        </div>
    </div>
</template>

<style src="./TrendingProductsList.scss" lang="scss"></style>
<script src="./TrendingProductsList.js"></script>
