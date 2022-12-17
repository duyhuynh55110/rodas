<template>
    <div class="deals-search">
        <!-- Search form -->
        <div class="container">
            <form ref="searchForm" class="searchbar searchbar-init search-box list-search-bx" @submit.prevent="onSubmitSearch">
                <!-- Input search -->
                <div class="searchbar-inner">
                    <div class="searchbar-input-wrap">
                        <input
                            type="search"
                            placeholder="Search here"
                            v-model="inputSearch"
                            autocomplete="true"
                            @keyup="onKeyUpInputSearch"
                        />
                    </div>
                </div>

                <!-- Suggest list -->
                <div v-if="suggestList.length > 0" class="suggest-list">
                    <div @click="onClickSuggestion(suggest)" v-for="(suggest, i) in suggestList" :key="i" class="search-suggestion">
                        <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                        <span> {{ suggest }} </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<style src="./SearchBar.scss" lang="scss" scoped></style>
<script src="./SearchBar.js"></script>
