<template>
    <screen-loading v-if="this.isPageLoading" />
    <div class="container" v-else>
        <!-- Notification bar -->
        <NotificationBar />

        <!-- Swiper - Posts area -->
        <GiftBoxCardsArea :giftBoxes="this.giftBoxes" />

        <!-- Swiper - Categories area -->
        <TitleBar :title="$t('categories')" linkTo="/categories" />
        <CategorySlidesArea :categories="this.categories" />

        <!-- Trending items area -->
        <TitleBar :title="$t('trending deals')" linkTo="/products" />
        <div class="row">
            <!-- Item boxes -->
            <div class="col-50" v-for="product in products" :key="product.id">
                <ItemBox
                    :item="product"
                    @clickFavoriteIcon="onClickFavoriteIcon(product)"
                />
            </div>

            <!-- Load more button -->
            <div class="col-100">
                <ButtonPrimary
                    v-if="showLoadMoreBtn"
                    :content="$t('load more')"
                    customClass="text-capitalize"
                    @on-click="loadTrendingItems"
                />
                <div v-if="isLoadingProducts" class="loading-products">
                    <LoadingData />
                </div>
            </div>
        </div>
    </div>
</template>

<style src="./HomeView.scss" lang="scss" scoped></style>
<script src="./HomeView.js"></script>
