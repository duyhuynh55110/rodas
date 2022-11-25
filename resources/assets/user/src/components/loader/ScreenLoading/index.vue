<template>
    <div class="screen-loading">
        <div class="container">
            <div class="logo">
                <img class="logo-icon" :src="require('@/assets/img/logo.png')" />
            </div>

            <img
                class="three-dots-icon"
                :src="require('@/assets/img/svg/screen-loading.svg')"
            />
        </div>
    </div>
</template>

<style src="./ScreenLoading.scss" scoped lang="scss"></style>
<script src="./ScreenLoading.js"></script>
