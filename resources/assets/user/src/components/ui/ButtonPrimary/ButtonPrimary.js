export default {
    name: "ButtonPrimary",
    props: {
        content: {
            type: String,
            required: true,
        },
        customClass: {
            type: String,
            required: false,
            default: '',
        },
    },
    computed: {
        getClass: function () {
            return "button button-fill button-large " + this.customClass;
        }
    },
    methods: {
        onClick: function (e) {
            this.$emit('on-click', e);
        }
    }
}
