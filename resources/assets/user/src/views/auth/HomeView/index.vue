<template>
    <screen-loading v-if="this.isPageLoading"/>
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
        <ItemBoxList :items="this.products" />
    </div>
</template>
<script src="./HomeView.js"></script>
