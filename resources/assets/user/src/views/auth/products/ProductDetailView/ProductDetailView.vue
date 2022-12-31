<template>
    <div class="item-detail">
        <navbar :navbarStyle="navbarStyle" :navbarTransparent="true">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
            <template v-slot:right>
                <link-icon linkIcon="link-menu" />
            </template>
        </navbar>

        <!-- Thumbnail -->
        <div class="item-thumbnail" style="background: url(https://kede.dexignzone.com/xhtml/img/slider/slide1.jpg);"></div>
        <div class="dz-banner-height"></div>

        <!-- Information -->
        <div class="fixed-content">
            <div class="container">
                <!-- Brand name, Item name -->
                <div class="item-info">
                    <div class="clearfix">
                        <h3 class="brand-name"> FRUITS </h3>
                        <h2 class="item-name"> Item Name </h2>
                    </div>
                </div>

                <!-- Currency, Quantity -->
                <div class="item-info">
                    <h2 class="text-primary item-price">$4.9</h2>

                    <Stepper />
                </div>

                <!-- Tab swiper -->
                <TabSwiper />
            </div>
        </div>
    </div>
</template>

<style src="./ProductDetailView.scss" lang="scss" scoped></style>
<script src="./ProductDetailView.js"></script>

