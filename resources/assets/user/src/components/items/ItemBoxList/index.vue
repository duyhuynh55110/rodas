<template>
    <div class="row">
        <!-- Item boxes -->
        <div class="col-50" v-for="item in items" :key="item.id">
            <ItemBox :item="item" />
        </div>

        <!-- Load more button -->
        <div class="col-100">
            <ButtonPrimary :content="$t('load more')" customClass="text-capitalize" />
        </div>
    </div>
</template>

<script src="./ItemBoxList.js"></script>
