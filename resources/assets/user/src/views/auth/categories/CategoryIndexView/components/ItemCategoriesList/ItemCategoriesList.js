import { mapState } from "vuex";

export default {
    name: 'ItemCategoriesList',
    computed: {
        ...mapState('categoryIndexView', ['categories']),
    }
}
