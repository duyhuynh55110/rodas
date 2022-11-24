import ProductService from "@/services/products.service";

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
            const service = new ProductService();
            const { data } = await service.getProducts();

            commit('setProducts', data);
        }
    },
    getters: {},
};
