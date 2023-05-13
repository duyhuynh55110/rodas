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
            v-model:name="form.name"
            v-model:email="form.email"
            v-model:zipCode="form.zipCode"
            v-model:city="form.city"
            v-model:countryId="form.countryId"
            v-model:phoneNumber="form.phoneNumber"
            @nextStep="nextStep"
        />
        <PaymentMethodTab
            v-show="activeTab(1)"
            v-model:address="form.address"
            @complete="onClickCompleteBtn"
        />
    </div>
</template>

<script src="./CheckoutView.js"></script>
<style src="./CheckoutView.scss" lang="scss" scoped></style>
