<template>
    <div class="gift-boxes-area mb-30">
        <swiper
            :autoplay="autoplay"
            :modules="modules"
            :space-between="20"
            :pagination="true"
        >
            <swiper-slide v-for="giftBox in giftBoxes" :key="giftBox.id">
                <GiftBoxCard :giftBox="giftBox" />
            </swiper-slide>
        </swiper>
    </div>
</template>

<script src="./GiftBoxCardsArea.js"></script>
