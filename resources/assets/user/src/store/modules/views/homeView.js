import {
    compositionService,
    favoriteService,
    productService,
} from "@/services";
import { PAGE_DEFAULT } from "@/utils/constants";

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
    },
    actions: {
        loadCompositionData: async function ({ commit }) {
            const { data } = await compositionService.getHomeViewData();

            commit("setGiftBoxes", data.gift_boxes);
            commit("setCategories", data.categories);
        },
        loadProducts: async function ({ state, commit }) {
            const params = {
                page: state.productsPagination?.current_page
                    ? state.productsPagination.current_page + 1
                    : PAGE_DEFAULT,
            };

            // start fetching
            commit("setIsLoadingProducts", true);

            // call api
            const { data, pagination } = await productService.getProducts(
                params
            );

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
