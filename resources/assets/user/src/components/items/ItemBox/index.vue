<template>
    <div class="item-box">
        <div class="item-media">
            <img :src="this.item.image_url" alt="" />
        </div>
        <router-link to="" :class="this.itemBookmarkClass" @click="onClickFavoriteIcon">
            <font-awesome-icon icon="fa fa-heart" />
            <input type="checkbox" />
        </router-link>
        <div class="item-content">
            <h3 class="title">
                <router-link :to="{
                    name: 'items.detail',
                    params: { id: this.item.id }
                }"> {{ this.item.name }} </router-link>
            </h3>
            <h4 class="price">${{ this.item.item_price }}</h4>
        </div>
    </div>
</template>
<style src="./ItemBox.scss" scoped lang="scss"></style>
<script src="./ItemBox.js"></script>
