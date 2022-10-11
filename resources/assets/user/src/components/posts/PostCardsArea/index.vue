<template>
    <div class="posts-area mb-30">
        <swiper
            :autoplay="autoplay"
            :modules="modules"
            :space-between="20"
            :pagination="true"
        >
            <swiper-slide v-for="post in posts" :key="post.id">
                <PostCard :post="post" />
            </swiper-slide>
        </swiper>
    </div>
</template>
<style src="./PostCardsArea.scss" scoped lang="scss"></style>
<script src="./PostCardsArea.js"></script>
