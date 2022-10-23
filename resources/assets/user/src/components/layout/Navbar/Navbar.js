export default {
    name: "Navbar",
    props: {
        title: {
            type: String,
            required: true,
        },
    },
    computed: {
        hasLeftSlot: function () {
            return !!this.$slots.left;
        },
    }
}
