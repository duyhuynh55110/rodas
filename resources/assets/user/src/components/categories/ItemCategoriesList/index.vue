<template>
    <div class="row item-categories">
        <div v-for="category in categories" :key="category.id" class="col-100">
            <a href="/deals/" class="item-category">
                <div class="item-info">
                    <h3 class="title"> {{ category.name }} </h3>
                    <p>0 {{ $t('items') }}</p>
                </div>
                <img
                    :src="category.full_path_image"
                    :alt="category.name"
                    class="layer-icon"
                />
                <div class="item-icon">
                    <img
                        :src="category.full_path_image"
                        :alt="category.name"
                    />
                </div>
            </a>
        </div>
    </div>
</template>

<style src="./ItemCategoriesList.scss" scoped lang="scss"></style>
<script src="./ItemCategoriesList.js"></script>
