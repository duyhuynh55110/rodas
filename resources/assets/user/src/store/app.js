import { authService } from "@/services";

export default {
    namespaced: true,
    state: () => ({
        auth: null, // user's profile
    }),
    mutations: {
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
