<template>
    <div>
        <Navbar title="Shopping Cart">
            <template v-slot:right>
                <a href="/shipping-address/"> Checkout </a>
            </template>
        </Navbar>

        <div class="container">
            <CartItemsArea />
        </div>
    </div>
</template>
<script src="./ShoppingCartView.js"></script>
