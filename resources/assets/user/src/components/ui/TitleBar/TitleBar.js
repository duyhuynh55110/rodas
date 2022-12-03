export default {
    name: "TitleBar",
    props: {
        title: {
            type: String,
            required: true,
        },
        linkTo: {
            type: String,
            required: false,
        }
    },
    computed: {
        // condition to show arrow right icon
        showArrowRightIcon: function () {
            return this.linkTo;
        }
    }
}
