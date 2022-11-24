import { productService } from "@/services";

export default {
    namespaced: true,
    state: () => ({
        products: [], // List products
    }),
    mutations: {
        setProducts: function (state, products) {
            state.products = products;
        }
    },
    actions: {
        loadProducts: async function ({ commit }) {
            const { data } = await productService.getProducts();

            commit('setProducts', data);
        }
    },
    getters: {},
};
