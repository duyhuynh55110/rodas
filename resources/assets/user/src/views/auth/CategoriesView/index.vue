<template>
    <div>
        <Navbar :title="$t('categories')" :navbarStyle="navbarStyle">
            <template v-slot:left>
                <a href="#" class="link back">
                    <font-awesome-icon icon="fa-solid fa-arrow-left" />
                </a>
            </template>
        </Navbar>

        <div class="container">
            <ItemCategoriesList :categories="categories" />
        </div>
    </div>
</template>
<script src="./CategoriesView.js"></script>
