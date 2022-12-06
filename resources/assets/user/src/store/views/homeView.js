import {
    compositionService,
    favoriteService,
    productService,
} from "@/services";
import { nextPage } from "@/utils/helper";

export default {
    namespaced: true,
    state: () => ({
        giftBoxes: [], // gift boxes list
        categories: [], // categories list
        isLoadingProducts: false, // is fetching products list
        products: [], // products list
        productsPagination: {}, // pagination for 'products' list
    }),
    mutations: {
        setGiftBoxes: function (state, giftBoxes) {
            state.giftBoxes = giftBoxes;
        },
        setCategories: function (state, categories) {
            state.categories = categories;
        },
        setProducts: function (state, products) {
            state.products = [...state.products, ...products];
        },
        setProductsPagination: function (state, productsPagination) {
            state.productsPagination = productsPagination;
        },
        setProductInList: function (state, product) {
            const products = state.products.map((productItem) => {
                if (productItem.id == product.id) {
                    productItem = product;
                }

                return productItem;
            });

            state.products = products;
        },
        setIsLoadingProducts: function (state, isLoadingProducts) {
            state.isLoadingProducts = isLoadingProducts;
        },
        resetState: function (state) {
            state.giftBoxes = [];
            state.categories = [];
            state.products = [];
            state.productsPagination = {};
        }
    },
    actions: {
        loadCompositionData: async function ({ commit }) {
            const { data } = await compositionService.getHomeViewData();

            commit("setGiftBoxes", data.gift_boxes);
            commit("setCategories", data.categories);
        },
        loadProducts: async function ({ state, commit }) {
            // start fetching
            commit("setIsLoadingProducts", true);

            // call api
            const { data, pagination } = await productService.getProducts({
                page: nextPage(state.productsPagination),
            });

            // set data
            commit("setProducts", data);
            commit("setProductsPagination", pagination);

            // end fetching
            commit("setIsLoadingProducts", false);
        },
        createFavorite: async function ({ commit }, productId) {
            const { data } = await favoriteService.createFavorite(productId);

            commit("setProductInList", data);
        },
        removeFavorite: async function ({ commit }, productId) {
            const { data } = await favoriteService.removeFavorite(productId);

            commit("setProductInList", data);
        },
    },
    getters: {},
};
