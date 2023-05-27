<template>
    <div class="container">
        <!-- Navbar -->
        <navbar title="Checkout">
            <template v-slot:left>
                <link-icon @customClick="onClickBackBtn" linkIcon="link-back" />
            </template>
        </navbar>

        <!-- Sticky step by step -->
        <div class="sticky-top">
            <ul>
                <li v-for="(tab, index) in tabs" :key="index" :class="stickyClass(index)">
                    <a href="nav-link"> {{ tab.stickyName }} </a>
                </li>
            </ul>
        </div>

        <DeliveryAddressTab
            v-show="activeTab(0)"
            :formData="formData"
            :countries="countries"
            @nextStep="nextStep"
        />
        <PaymentMethodTab
            v-show="activeTab(1)"
            :formData="formData"
            @complete="onClickCompleteBtn"
        />
    </div>
</template>

<script src="./CheckoutView.js"></script>
<style src="./CheckoutView.scss" lang="scss" scoped></style>
