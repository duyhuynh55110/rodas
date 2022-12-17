<template>
    <div>
        <navbar :navbarStyle="navbarStyle" :navbarTransparent="true">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
            <template v-slot:right>
                <link-icon linkIcon="link-menu" />
            </template>
        </navbar>

        <!-- Category Banner -->
        <BannerHeading :category="category" />

        <div class="dz-content">
            <!-- Search -->
            <SearchBar />

            <!-- Products list -->
            <SearchProductsList :products="products" />
        </div>
    </div>
</template>

<style src="./CategoryDetailView.scss" lang="scss" scoped></style>
<script src="./CategoryDetailView.js"></script>
