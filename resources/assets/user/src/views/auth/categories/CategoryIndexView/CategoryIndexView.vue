<template>
    <div>
        <navbar :title="$t('categories')" :navbarStyle="navbarStyle">
            <template v-slot:left>
               <link-icon linkIcon="link-back" />
            </template>
        </navbar>

        <div class="container">
            <ItemCategoriesList :categories="categories" />
        </div>
    </div>
</template>
<script src="./CategoryIndexView.js"></script>
