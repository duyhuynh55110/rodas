<template>
    <div>
        <navbar :title="$t('shopping cart')">
            <template v-slot:right>
                <a href="/shipping-address/"> {{ $t('checkout') }} </a>
            </template>
        </navbar>

        <div class="container">
            <CartItemList />
        </div>
    </div>
</template>
<script src="./ShoppingCartView.js"></script>
