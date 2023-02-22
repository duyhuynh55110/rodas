<template>
    <div>
        <navbar :title="$t('shopping cart')">
            <template v-slot:right>
                <a href="/shipping-address/"> {{ $t("checkout") }} </a>
            </template>
        </navbar>

        <div class="container">
            <div class="cart-items-list">
                <CartItem
                    v-for="(product, index) in products"
                    :key="index"
                    :product="product"
                    @showModalRemoveProduct="showModalRemoveProduct"
                />
            </div>
        </div>

        <!-- Confirm remove product from cart popup -->
        <ConfirmPopup @clickConfirmBtn="onClickConfirmBtn" />
        <LayoutPopup modalName="tests" />
    </div>
</template>
<script src="./ShoppingCartView.js"></script>
