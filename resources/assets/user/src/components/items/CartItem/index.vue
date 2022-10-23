<template>
    <div class="cart-item">
        <div class="item-inner">
            <div class="item-media">
                <img
                    src="https://kede.dexignzone.com/xhtml/img/categories/pic1.jpg"
                    alt=""
                />
                <h3 class="item-price bg-primary">$7.2</h3>
            </div>
            <div class="item-info">
                <div class="item-head">
                    <h6 class="category">FRUITS</h6>
                    <h2 class="item-title">
                        <a href="/item-details/">Banana</a>
                    </h2>
                </div>
                <div class="item-foot">
                    <h3 class="text-primary item-total">$28.8</h3>
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
                </div>
            </div>
        </div>
    </div>
</template>
<style src="./CartItem.scss" scoped lang="scss"></style>
<script src="./CartItem.js"></script>
