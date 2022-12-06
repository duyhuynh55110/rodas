<template>
    <div class="dz-banner-heading">
        <div class="container">
            <h2 class="head-title text-white"> {{ category.name }} </h2>
            <p class="item-qty text-white"> {{ category.products_count + ' ' + $t('items') }} </p>
            <div class="category-icon">
                <img
                    src="https://kede.dexignzone.com/xhtml/img/svg/grapes.svg"
                    alt=""
                />
            </div>
        </div>
    </div>
</template>

<style src="./BannerHeading.scss" lang="scss" scoped></style>
<script src="./BannerHeading.js"></script>
