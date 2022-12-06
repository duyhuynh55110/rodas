import { redirectWithQuery } from "@/utils/helper";
import { PRODUCT_KEYWORDS } from "@/utils/keywords";

export default {
    name: "SearchBar",
    data() {
        return {
            inputSearch: null,
            suggestList: [],
        }
    },
    methods: {
        // event when submit search form
        onSubmitSearch: async function () {
            redirectWithQuery({
                search: this.inputSearch ?? null,
            });
        },
        // event when keyup any keyboard from input search
        onKeyUpInputSearch: function (e) {
            // if keyword empty || 'Enter' key, return []
            if(!this.inputSearch || e.key == 'Enter') {
                this.suggestList = [];
                return;
            }

            this.suggestList = PRODUCT_KEYWORDS.splice(0, 10);
        },
        // event when click a suggestion text
        onClickSuggestion: function(suggestText) {
            this.inputSearch = suggestText;
            this.suggestList = [];

            this.onSubmitSearch();
        }
    }
}
