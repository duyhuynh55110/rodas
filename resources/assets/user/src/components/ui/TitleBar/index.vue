<template>
    <div class="title-bar mb-15">
        <h3 class="dz-title my-5">{{ title }}</h3>
        <router-link
        v-if="showArrowRightIcon"
        :to="{
            path: linkTo,
        }">
            <font-awesome-icon icon="fa-solid fa-arrow-right" />
        </router-link>
    </div>
</template>
<style src="./TitleBar.scss" scoped lang="scss"></style>
<script src="./TitleBar.js"></script>
