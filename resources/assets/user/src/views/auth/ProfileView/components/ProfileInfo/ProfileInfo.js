import { mapState } from "vuex";

export default {
    name: "ProfileInfo",
    computed: {
        ...mapState('app', ['auth']),
    },
}
