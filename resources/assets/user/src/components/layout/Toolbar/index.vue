<template>
    <div class="toolbar tabbar tabbar-labels toolbar-bottom menubar-area">
        <div class="toolbar-inner">
            <router-link class="tab-link" active-class="active" to="/" exact>
                <font-awesome-icon icon="fa-solid fa-house" />
            </router-link>
            <router-link
                class="tab-link"
                active-class="active"
                to="/categories"
            >
                <font-awesome-icon icon="fa-solid fa-arrow-right-arrow-left" />
            </router-link>
            <router-link
                class="tab-link"
                active-class="active"
                to="/shopping-cart"
            >
                <div class="cart-in active">
                    <font-awesome-icon icon="fa-solid fa-cart-shopping" />
                </div>
            </router-link>
            <router-link class="tab-link" active-class="active" to="/wishlist">
                <font-awesome-icon icon="fa fa-heart" />
            </router-link>
            <router-link class="tab-link" active-class="active" to="/user-menu">
                <img
                    src="https://kede.dexignzone.com/xhtml/img/avatar/1.jpg"
                    class="user-media"
                    alt=""
                />
            </router-link>
        </div>
    </div>
</template>
<style src="./Toolbar.scss" scoped lang="scss"></style>
<script src="./Toolbar.js"></script>
