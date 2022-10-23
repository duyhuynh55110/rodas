<template>
    <div class="row">
        <!-- Item boxs -->
        <div class="col-50" v-for="item in items" :key="item.id">
            <ItemBox :item="item" />
        </div>

        <!-- Load more button -->
        <div class="col-100">
            <ButtonPrimary content="LOAD MORE" />
        </div>
    </div>
</template>
<style src="./ItemBoxList.scss" scoped lang="scss"></style>
<script src="./ItemBoxList.js"></script>
