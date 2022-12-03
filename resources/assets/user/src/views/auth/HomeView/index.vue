<template>
    <screen-loading v-if="this.isPageLoading" />
    <div class="container" v-else>
        <!-- Notification bar -->
        <NotificationBar />

        <!-- Swiper - Posts area -->
        <GiftBoxSwiper />

        <!-- Swiper - Categories area -->
        <TitleBar :title="$t('categories')" linkTo="/categories" />
        <CategorySwiper />

        <!-- Trending items area -->
        <TitleBar :title="$t('trending deals')" linkTo="/products" />
        <TrendingProductsList />
    </div>
</template>

<style src="./HomeView.scss" lang="scss" scoped></style>
<script src="./HomeView.js"></script>
