import { mapState } from "vuex";

export default {
    name: "BannerHeading",
    computed: {
        ...mapState('categoryDetailView', ['category'])
    },
}
