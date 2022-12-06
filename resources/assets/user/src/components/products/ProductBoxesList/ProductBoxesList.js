import LoadingData from "@/components/loader/LoadingData";
import ButtonPrimary from "@/components/ui/ButtonPrimary";
import ProductBox from "./components/ProductBox";

export default {
    name: "ProductBoxesList",
    components: {
        ProductBox,
        LoadingData,
        ButtonPrimary,
    },
    props: {
        products: {
            type: Array,
            required: true,
        },
        productsPagination: {
            type: Object,
        },
        loadMoreLimited: {
            type: Number,
        }
    },
    data() {
        return {
            isLoadingProducts: false,
        }
    },
    computed: {
        showLoadMoreBtn: function () {
            const isFinalPage = !(this.productsPagination.current_page >= this.productsPagination.total_pages);
            const isFetchingData = this.isLoadingProducts;

            // hide on fetching data
            if (isFetchingData) {
                return false;
            }

            // hide if load more than limited
            if(this.loadMoreLimited && this.productsPagination.current_page > this.loadMoreLimited) {
                return false;
            }

            // hide if current page is final page
            return isFinalPage;
        },
    },
    methods: {
        setIsLoadingPage: function (isLoadingProducts) {
            this.isLoadingProducts = isLoadingProducts;
        },
        // event when click favorite icon ProductBox component
        onClickFavoriteIcon: function (product) {
            this.$emit("clickFavoriteIcon", product);
        },
        // event on click load more btn
        onClickLoadMoreBtn: function () {
            let _this = this;

            // start loading products list
            this.isLoadingProducts = true;

            // emit & callback update load completed
            this.$emit("clickLoadMoreBtn", () => {
                _this.isLoadingProducts = false;
            });
        },
    },
};
