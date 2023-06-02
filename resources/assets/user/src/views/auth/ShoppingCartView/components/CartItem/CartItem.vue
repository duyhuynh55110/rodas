<template>
    <div class="cart-item">
        <div class="item-inner">
            <!-- Product thumbnail, price -->
            <div class="item-media">
                <img
                    :src="product.image_url"
                    alt=""
                />
                <h3 class="item-price bg-primary"> {{ $helper.formatMoney(product.item_price) }} </h3>
            </div>

            <!-- Product info -->
            <div class="item-info">
                <!-- Brand name, Product name -->
                <div class="item-head">
                    <h6 class="brand"> {{ brand.name }} </h6>
                    <h2 class="item-title">
                        <router-link :to="{
                            name: 'products.detail',
                            params: {
                                id: product.id
                            }
                        }"> {{ product.name }} </router-link>
                    </h2>
                </div>

                <!-- Total price, Input quantity -->
                <div class="item-foot">
                    <h3 class="text-primary item-total"> {{ $helper.formatMoney(amount) }} </h3>
                    <Stepper
                        :dfQuantity="product.quantity"
                        v-model:quantity="quantity"
                        @removeProduct="$emit('showModalRemoveProduct', product.id)"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<style src="./CartItem.scss" scoped lang="scss"></style>
<script src="./CartItem.js"></script>
