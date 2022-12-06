import { mapState } from "vuex";

export default {
    name: "ProfileList",
    computed: {
        ...mapState('app', ['auth']),
    },
}
