<template>
    <div class="row">
        <div class="col-50" v-for="product in products" :key="product.id">
            <ProductBox
                :product="product"
                @clickFavoriteIcon="onClickFavoriteIcon"
            />
        </div>

        <!-- Load more button -->
        <div class="col-100" v-show="productsPagination">
            <ButtonPrimary
                v-if="showLoadMoreBtn"
                :content="$t('load more')"
                class="text-capitalize"
                @clickButton="onClickLoadMoreBtn"
            />
            <div v-if="isLoadingProducts" class="loading-products">
                <LoadingData />
            </div>
        </div>
    </div>
</template>

<style src="./ProductBoxesList.scss" lang="scss" scoped></style>
<script src="./ProductBoxesList.js"></script>

