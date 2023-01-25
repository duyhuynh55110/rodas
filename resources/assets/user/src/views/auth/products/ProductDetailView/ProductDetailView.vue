<template>
    <div class="item-detail">
        <navbar :navbarTransparent="true">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
            <template v-slot:right>
                <link-icon linkIcon="link-menu" />
            </template>
        </navbar>

        <!-- Product Slides -->
        <swiper
            :pagination="true"
            :modules="modules"
            class="product-slides-content"
        >
            <swiper-slide
                v-for="(productSlide, index) in productSlides"
                :key="index"
            >
                <img :src="productSlide.image_url" />
            </swiper-slide>
        </swiper>
        <div class="dz-banner-height"></div>

        <!-- Information -->
        <div class="fixed-content">
            <div class="container">
                <!-- Brand name, Item name -->
                <div class="item-info">
                    <div class="clearfix">
                        <h3 class="brand-name">{{ brand.name }}</h3>
                        <h2 class="item-name">{{ product.name }}</h2>
                    </div>
                </div>

                <!-- Currency, Quantity -->
                <div class="item-info">
                    <h2 class="text-primary item-price">
                        {{ $helper.formatMoney(product.item_price) }}
                    </h2>

                    <Stepper v-model:quantity="quantity" />
                </div>

                <!-- Tab swiper -->
                <TabSwiper :product="product" />

                <!-- Product toolbar -->
                <div class="product-detail-btn">
                    <div class="container px-15">
                        <div class="row">
                            <div class="col-30">
                                <button
                                    :class="addWishlistBtnClass"
                                    @click="onClickAddWishlistBtn"
                                    :disabled="isProcessFavorite"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-heart"
                                    />
                                </button>
                            </div>
                            <div class="col-70">
                                <button
                                    @click="onClickAddToCartBtn"
                                    :disabled="isProcessAddToCart"
                                    class="button-large button add-cart-btn button-fill text-uppercase"
                                >
                                    add to cart
                                    <br />
                                    <span class="price">
                                        {{ $helper.formatMoney(amount) }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success popup -->
        <SuccessPopup>
            <template v-slot:content>
                <div class="popup-container row">
                    <div class="col-100">
                        <p class="message-success">
                            Sản phẩm dc thêm vào giỏ hàng
                        </p>
                    </div>
                    <div class="col-40">
                        <img :src="product.image_url" alt="" class="item-banner" />
                    </div>
                    <div class="col-60">
                        <div class="item-info">
                            <h3 class="brand-name">{{ brand.name }}</h3>
                            <h2 class="item-name">{{ product.name }}</h2>
                            <h2 class="text-primary item-price">{{ $helper.formatMoney(amount) }}</h2>
                        </div>
                    </div>
                    <div class="col-100">
                        <router-link to="/shopping-cart" class="goto-cart-btn"> Go to cart </router-link>
                    </div>
                </div>
            </template>
        </SuccessPopup>
    </div>
</template>

<style src="./ProductDetailView.scss" lang="scss" scoped></style>
<script src="./ProductDetailView.js"></script>
