<template>
    <div class="filter-condition">
        <button
            v-for="(filterButton, index) in filterButtons"
            :class="{
                'filter-button': true,
                'active': filterButton.activeClass,
            }"
            :key="index"
            :disabled="isLoadingData"
            @click="onClickFilterButton(index)"> {{ filterButton.text }} </button>
    </div>
</template>

<style src="./FilterCondition.scss" lang="scss" scoped></style>
<script src="./FilterCondition.js"></script>
