<template>
    <div class="container">
        <!-- Notification bar -->
        <NotificationBar />

        <!-- Swiper - Posts area -->
        <GiftBoxSwiper :giftBoxes="giftBoxes" />

        <!-- Swiper - Categories area -->
        <TitleBar :title="$t('categories')" linkTo="/categories" />
        <CategorySwiper :categories="categories" />

        <!-- Trending items area -->
        <TitleBar :title="$t('trending deals')" linkTo="/categories" />
        <TrendingProductsList :products="products" />

        <!-- toolbar -->
        <toolbar />
    </div>
</template>

<style src="./HomeView.scss" lang="scss" scoped></style>
<script src="./HomeView.js"></script>
