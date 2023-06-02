<template>
     <div class="stepper">
        <button class="stepper-button-minus" @click="onClickChangeQuantityBtn('-')">-</button>
        <div class="stepper-input-wrap">
            <input
                type="number"
                step="1"
                v-model="quantity"
                @focusout="onFocusoutInputQuantity"
            />
        </div>
        <button class="stepper-button-plus" @click="onClickChangeQuantityBtn('+')">+</button>
    </div>
</template>

<style src="./Stepper.scss" lang="scss" scoped></style>
<script src="./Stepper.js"></script>
