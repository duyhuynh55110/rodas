<template>
    <screen-loading v-if="this.isPageLoading" />
    <div  v-else>
        <navbar :navbarStyle="navbarStyle" :navbarTransparent="true">
            <template v-slot:left>
                <link-icon linkIcon="link-back" />
            </template>
            <template v-slot:right>
                <link-icon linkIcon="link-menu" />
            </template>
        </navbar>

        <!-- Category Banner -->
        <BannerHeading />

        <!--  Category's Products -->
        <div class="dz-content">
            <SearchBar />

            <SearchProductsList />
        </div>
    </div>
</template>

<style src="./CategoryDetailView.scss" lang="scss" scoped></style>
<script src="./CategoryDetailView.js"></script>
