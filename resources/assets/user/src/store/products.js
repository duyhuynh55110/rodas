import { favoriteService, productService } from "@/services";

export default {
    namespaced: true,
    state: () => ({
        products: [], // products list
        productsPagination: {}, // pagination for 'products' list
    }),
    mutations: {
        setProducts: function (state, products) {
            state.products = products;
        },
        setProductsPagination: function (state, productsPagination) {
            state.productsPagination = productsPagination;
        },
        setProductInList: function(state, product) {
            const products = state.products.map(productItem => {
                if(productItem.id == product.id) {
                    productItem = product;
                }

                return productItem;
            });

            state.products = products;
        }
    },
    actions: {
        loadProducts: async function ({ commit }) {
            const { data, pagination } = await productService.getProducts();

            commit('setProducts', data);
            commit('setProductsPagination', pagination);
        },
        createFavorite: async function ({ commit }, productId) {
            const { data } = await favoriteService.createFavorite(productId);

            commit('setProductInList', data);
        }
    },
    getters: {},
};
