import {
    favoriteService,
} from "@/services";
import { nextPage } from "@/utils/helper";

export default {
    namespaced: true,
    state: () => ({
        isLoadingProducts: false, // is fetching products list
        products: [], // products list
        productsPagination: {}, // pagination for 'products' list
    }),
    mutations: {
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
        loadProducts: async function ({ state, commit }) {
            // start fetching
            commit("setIsLoadingProducts", true);

            // call api
            const { data, pagination } = await favoriteService.getProducts({
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
