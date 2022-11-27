
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
    actions: {},
    getters: {},
};
