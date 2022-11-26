export default {
    namespaced: true,
    state: () => ({
        giftBoxes: [],
    }),
    mutations: {
        setGiftBoxes: function (state, giftBoxes) {
            state.giftBoxes = giftBoxes;
        }
    }
};
