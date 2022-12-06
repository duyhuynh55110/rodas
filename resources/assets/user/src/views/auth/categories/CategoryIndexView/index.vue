<template>
    <screen-loading v-if="this.isPageLoading" />
    <div v-else>
        <navbar :title="$t('categories')" :navbarStyle="navbarStyle">
            <template v-slot:left>
               <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <div class="container">
            <ItemCategoriesList />
        </div>
    </div>
</template>
<script src="./CategoryIndexView.js"></script>
