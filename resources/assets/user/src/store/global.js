import { compositionService } from "@/services";

export default {
    namespaced: true,
    state: () => ({
        isPageLoading: true, // app was fetching data for page
    }),
    mutations: {
        setIsPageLoading: function (state, isPageLoading) {
            state.isPageLoading = isPageLoading;
        }
    },
    actions: {
        loadCompositionHomeView: async function ({ commit }) {
            const { data } = await compositionService.getHomeViewData();

            // { root: true }, change another module state from one module
            commit('categories/setCategories', data.data.categories, { root: true });
        }
    },
    getters: {},
};
