import { authService } from "@/services";

export default {
    namespaced: true,
    state: () => ({
        isPageLoading: true, // app was fetching data for page
        auth: null, // user's profile
    }),
    mutations: {
        setIsPageLoading: function (state, isPageLoading) {
            state.isPageLoading = isPageLoading;
        },
        setAuth: function (state, auth) {
            state.auth = auth;
        }
    },
    actions: {
        // load user's profile
        loadAuth: async function ({ commit }) {
            const { data } = await authService.getUserProfile();

            commit('setAuth', data);
        },
    },
    getters: {},
};
