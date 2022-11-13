<template>
    <div>
        <Navbar :title="$t('shopping cart')">
            <template v-slot:right>
                <a href="/shipping-address/"> {{ $t('checkout') }} </a>
            </template>
        </Navbar>

        <div class="container">
            <CartItemList />
        </div>
    </div>
</template>
<script src="./ShoppingCartView.js"></script>
