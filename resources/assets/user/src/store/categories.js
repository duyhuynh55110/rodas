export default {
    namespaced: true,
    state: () => ({
        categories: [],
    }),
    mutations: {
        setCategories: function (state, categories) {
            state.categories = categories;
        }
    }
};
