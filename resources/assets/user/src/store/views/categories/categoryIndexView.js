import { categoryService } from "@/services";

export default {
    namespaced: true,
    state: () => ({
        categories: [],
    }),
    mutations: {
        setCategories: function (state, categories) {
            state.categories = categories;
        },
    },
    actions: {
        // load categories list
        loadCategories: async function ({ commit }) {
            const { data } = await categoryService.getCategories();

            commit("setCategories", data);
        },
    },
    getters: {},
};
