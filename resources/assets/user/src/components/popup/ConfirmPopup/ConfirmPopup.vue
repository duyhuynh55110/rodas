<template>
    <LayoutPopup modalName="confirmPopup">
        <template v-slot:title> {{ $t('confirm') }} </template>

        <template v-slot:content>
            <p>{{ $t('do you want to delete the selected product?') }}</p>
        </template>
    </LayoutPopup>
</template>

<style src="./ConfirmPopup.scss" lang="scss" scoped></style>
<script src="./ConfirmPopup.js"></script>
