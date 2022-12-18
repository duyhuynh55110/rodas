export default {
    name: "ButtonPrimary",
    props: {
        content: {
            type: String,
            required: true,
        },
        class: { // user's custom class
            type: String,
            required: false,
            default: '',
        },
    },
    computed: {
        getClass: function () {
            return [
                "button",
                "button-fill",
                "button-large",
                this.class
            ];
        }
    },
    methods: {
        onClick: function (e) {
            this.$emit('clickButton', e);
        }
    }
}
