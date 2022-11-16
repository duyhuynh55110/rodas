<template>
    <div>
        <navbar :navbarStyle="navbarStyle" :navbarTransparent="true">
            <template v-slot:left>
                <a href="#" class="link back">
                    <font-awesome-icon icon="fa-solid fa-arrow-left" />
                </a>
            </template>
            <template v-slot:right>
                <a href="#">
                    <font-awesome-icon icon="fa-solid fa-bars" />
                </a>
            </template>
        </navbar>

        <div class="dz-banner-heading">
            <div class="container">
                <h2 class="head-title text-white">Fruits Category</h2>
                <p class="item-qty text-white">87 Items</p>
                <div class="category-icon">
                    <img
                        src="https://kede.dexignzone.com/xhtml/img/svg/grapes.svg"
                        alt=""
                    />
                </div>
            </div>
        </div>

        <div class="dz-content">
            <div class="deals-search">
                <div class="container">
                    <form
                        class="searchbar searchbar-init search-box list-search-bx"
                    >
                        <div class="searchbar-inner">
                            <div class="searchbar-input-wrap">
                                <input
                                    type="search"
                                    placeholder="Search here"
                                    class=""
                                />
                                <font-awesome-icon
                                    icon="fa-solid fa-magnifying-glass"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="search-list">
                <div class="container">
                    <ItemBoxList :items="this.items" />
                </div>
            </div>
        </div>
    </div>
</template>

<script src="./CategoryDetailView.js"></script>
<style src="./CategoryDetailView.scss" scoped lang="scss"></style>
