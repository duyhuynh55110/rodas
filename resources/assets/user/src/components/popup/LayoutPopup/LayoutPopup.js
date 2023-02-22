export default {
    name: "LayoutPopup",
    props: {
        modalName: {
            type: String,
            required: true,
        },
    },
    data: function () {
        return {
            showModal: false,
        }
    },
    methods: {
        // event on click 'cancel' btn -> close modal
        onClickCancelBtn: function () {
            this.showModal = false;
        }
    }
}
