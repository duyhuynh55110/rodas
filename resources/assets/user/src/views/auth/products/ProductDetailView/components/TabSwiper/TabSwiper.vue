<template>
    <div>
        <!-- Tab control -->
        <div class="toolbar">
            <div class="toolbar-inner">
                <a v-for="tabButton in tabButtons"
                    :key="tabButton.index"
                    @click="onClickTabButton(tabButton.index)"
                    :class="tabLinkClass(tabButton.index)"> {{ tabButton.text }} </a>
            </div>
        </div>

        <!-- Tab Swiper -->
        <swiper @swiper="onSwiper" @init="onSlideChange" @slideChange="onSlideChange">
            <swiper-slide v-html="product.description"></swiper-slide>
            <swiper-slide>Slide 2</swiper-slide>
            <swiper-slide>Slide 3</swiper-slide>
        </swiper>
    </div>
</template>

<style src="./TabSwiper.scss" lang="scss" scoped></style>
<script src="./TabSwiper.js"></script>
