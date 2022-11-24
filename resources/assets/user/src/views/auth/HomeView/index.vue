<template>
    <div class="container">
        <!-- Notification bar -->
        <NotificationBar />

        <!-- Swiper - Posts area -->
        <PostCardsArea :posts="this.posts" />

        <!-- Swiper - Categories area -->
        <TitleBar :title="$t('categories')" />
        <CategorySlidesArea />

        <!-- Trending items area -->
        <TitleBar :title="$t('trending deals')" />
        <ItemBoxList :items="this.products" />
    </div>
</template>
<script src="./HomeView.js"></script>
