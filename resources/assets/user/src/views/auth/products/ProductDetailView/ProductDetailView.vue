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
        <div class="item-thumbnail" :style="itemThumbnailStyle"></div>
        <div class="dz-banner-height"></div>

        <!-- Information -->
        <div class="fixed-content">
            <div class="container">
                <!-- Brand name, Item name -->
                <div class="item-info">
                    <div class="clearfix">
                        <h3 class="brand-name"> {{ brand.name }} </h3>
                        <h2 class="item-name"> {{ product.name }}</h2>
                    </div>
                </div>

                <!-- Currency, Quantity -->
                <div class="item-info">
                    <h2 class="text-primary item-price"> {{ $helper.formatMoney(product.item_price) }} </h2>

                    <Stepper />
                </div>

                <!-- Tab swiper -->
                <TabSwiper :product="product" />
            </div>
        </div>
    </div>
</template>

<style src="./ProductDetailView.scss" lang="scss" scoped></style>
<script src="./ProductDetailView.js"></script>

