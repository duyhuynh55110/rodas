<template>
     <div class="stepper">
        <div class="stepper-button-minus">-</div>
        <div class="stepper-input-wrap">
            <input
                type="text"
                value="4"
                min="0"
                max="100"
                step="1"
            />
        </div>
        <div class="stepper-button-plus">+</div>
    </div>
</template>

<style src="./Stepper.scss" lang="scss" scoped></style>
<script src="./Stepper.js"></script>
