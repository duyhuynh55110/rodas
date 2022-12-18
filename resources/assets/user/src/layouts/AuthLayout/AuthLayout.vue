<template>
    <div class="auth-layout">
        <!-- Banner Background -->
        <div class="dz-banner" :style="getBannerStyle"></div>
        <div class="dz-banner-height"></div>

        <div class="fixed-content py-30">
            <div class="container">
                <!-- Page content -->
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style src="./AuthLayout.scss" lang="scss" scoped></style>
<script src="./AuthLayout.js"></script>
