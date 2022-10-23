<template>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="left" v-if="this.hasLeftSlot">
                <slot name="left"></slot>
            </div>
            <div class="title">{{ title }}</div>
            <div class="right">
                <slot name="right"></slot>
            </div>
        </div>
    </div>
</template>

<script src="./Navbar.js"></script>
<style src="./Navbar.scss" scoped lang="scss"></style>
