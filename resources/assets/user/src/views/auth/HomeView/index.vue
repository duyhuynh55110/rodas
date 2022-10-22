<template>
    <div class="container">
        <!-- Notification bar -->
        <NotificationBar />

        <!-- Swiper - Posts area -->
        <PostCardsArea :posts="this.posts" />

        <!-- Swiper - Categories area -->
        <TitleBar title="Categories" />
        <CategorySlidesArea />

        <!-- Trending items area -->
        <TitleBar title="Trending Deals" />
        <TrendingItemsArea :items="this.trendingItems" />
    </div>
</template>
<script src="./HomeView.js"></script>
