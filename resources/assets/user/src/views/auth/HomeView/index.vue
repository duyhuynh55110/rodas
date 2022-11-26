<template>
    <screen-loading v-if="this.isPageLoading"/>
    <div class="container" v-else>
        <!-- Notification bar -->
        <NotificationBar />

        <!-- Swiper - Posts area -->
        <GiftBoxCardsArea :giftBoxes="this.giftBoxes" />

        <!-- Swiper - Categories area -->
        <TitleBar :title="$t('categories')" />
        <CategorySlidesArea />

        <!-- Trending items area -->
        <TitleBar :title="$t('trending deals')" />
        <ItemBoxList :items="this.products" />
    </div>
</template>
<script src="./HomeView.js"></script>
