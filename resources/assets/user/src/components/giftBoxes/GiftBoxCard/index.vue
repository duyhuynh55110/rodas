<template>
    <div class="gift-box-card">
        <div class="gift-box-media">
            <img :src="this.giftBox.image_url" alt="" />
        </div>
        <div class="gift-box-info">
            <h3 class="title">{{ this.giftBox.name }}</h3>
        </div>
    </div>
</template>
<style src="./GiftBoxCard.scss" scoped lang="scss"></style>
<script src="./GiftBoxCard.js"></script>
