<template>
    <div class="row item-categories">
        <div v-for="category in categories" :key="category.id" class="col-100">
            <router-link :to="{
                name: 'categories.detail',
                params: {
                    id: category.id
                }
            }" class="item-category">
                <div class="item-info">
                    <h3 class="title"> {{ category.name }} </h3>
                    <p>{{ category.products_count + ' ' + $t('items') }}</p>
                </div>
                <img
                    src="https://kede.dexignzone.com/xhtml/img/svg/grapes.svg"
                    :alt="category.name"
                    class="layer-icon"
                />
                <div class="item-icon">
                    <img
                        src="https://kede.dexignzone.com/xhtml/img/svg/grapes.svg"
                        :alt="category.name"
                    />
                </div>
            </router-link>
        </div>
    </div>
</template>

<style src="./ItemCategoriesList.scss" scoped lang="scss"></style>
<script src="./ItemCategoriesList.js"></script>
