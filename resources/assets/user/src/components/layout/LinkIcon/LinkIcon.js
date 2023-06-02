import { IconBack, IconMenu } from "./components"

export default {
    name: "LinkIcon",
    components: {
        IconBack,
        IconMenu,
    },
    props: {
        linkIcon: {
            type: String,
            required: true,
        }
    },
    emits: [
        // 'customClick', // Do not use or this.$attrs.onCustomClick will be undefined
    ],
    methods: {
        // on click icon
        onClick: function () {
            // custom event
            if(this.$attrs && this.$attrs.onCustomClick) {
                this.$emit('customClick')
                return false;
            }

            // default event
            this.$router.go(-1)
        }
    }
}
