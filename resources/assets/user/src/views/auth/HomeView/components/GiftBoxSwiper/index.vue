<template>
    <div class="gift-box-swiper mb-30">
        <swiper
            :autoplay="autoplay"
            :modules="modules"
            :space-between="20"
            :pagination="true"
        >
            <swiper-slide v-for="giftBox in giftBoxes" :key="giftBox.id">
                <div class="gift-box-slide">
                    <div class="gift-box-media">
                        <img :src="giftBox.image_url" alt="" />
                    </div>
                    <div class="gift-box-info">
                        <h3 class="title">{{ giftBox.name }}</h3>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
    </div>
</template>

<script src="./GiftBoxSwiper.js"></script>
