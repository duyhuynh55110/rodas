<template>
    <div class="product-box">
        <div class="product-media">
            <img :src="product.image_url" alt="" />
        </div>
        <router-link to="" :class="productBookmarkClass" @click="onClickFavoriteIcon">
            <font-awesome-icon icon="fa fa-heart" />
            <input type="checkbox" />
        </router-link>
        <div class="product-content">
            <h3 class="title">
                <router-link :to="{
                    name: 'products.detail',
                    params: { id: product.id }
                }"> {{ product.name }} </router-link>
            </h3>
            <h4 class="price">${{ product.item_price }}</h4>
        </div>
    </div>
</template>
<style src="./ProductBox.scss" scoped lang="scss"></style>
<script src="./ProductBox.js"></script>
