import { categoryService, favoriteService, productService } from "@/services";
import { nextPage } from "@/utils/helper";

export default {
    namespaced: true,
    state: () => ({
        id: null, // category's id
        search: null,
        category: null,
        products: [],
        productsPagination: [],
    }),
    mutations: {
        initialState: function (state, { id, search }) {
            state.id = id;
            state.search = search;
        },
        setCategory: function (state, category) {
            state.category = category;
        },
        setProducts: function (state, products) {
            state.products = [
                ...state.products,
                ...products,
            ];
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
        setProductsPagination: function(state, productsPagination) {
            state.productsPagination = productsPagination;
        }
    },
    actions: {
        // load a category by id
        loadCategory: async function ({ state, commit }) {
            const { data } = await categoryService.getCategoryById(state.id);

            commit('setCategory', data);
        },
        // load category's products list
        loadProducts: async function ({ state, commit }) {
            const { data, pagination } = await productService.getProducts({
                category_ids: state.id,
                search: state.search,
                page: nextPage(state.productsPagination)
            });

            commit("setProducts", data);
            commit("setProductsPagination", pagination);
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
