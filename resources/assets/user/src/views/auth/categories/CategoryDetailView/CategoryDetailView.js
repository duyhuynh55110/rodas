import { categoryService, favoriteService, productService } from "@/services";
import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { nextPage, setPaginate } from "@/utils/paginator";
import { useRoute } from "vue-router";

// components
import BannerHeading from "./components/BannerHeading/BannerHeading.vue";
import SearchBar from "./components/SearchBar/SearchBar.vue";
import SearchProductsList from "./components/SearchProductsList/SearchProductsList.vue";

// load products list with pagination
const fetchCategoryProducts = async function (page, search, id) {
    // call api
    const response = await productService.getProducts({
        category_ids: id,
        page,
        search,
    });

    return response;
};

export default {
    name: "CategoryDetailView",
    components: {
        BannerHeading,
        SearchProductsList,
        SearchBar
    },
    data: function () {
        return {
            navbarStyle: NAVBAR_STYLE_2,
            products: {},
        };
    },
    provide: function () {
        return {
            onClickFavoriteIcon: this.onClickFavoriteIcon,
            onClickLoadMoreBtn: this.onClickLoadMoreBtn,
        }
    },
    methods: {
        // update a product data in list
        setItemInProductsList: function (updateProduct) {
            const productsData = this.products.data.map((product) => {
                if (product.id == updateProduct.id) {
                    product = updateProduct;
                }

                return product;
            });

            this.products.data = productsData;
        },
        // event on click 'load more' button
        onClickLoadMoreBtn: async function (done) {
            const page = nextPage(this.products.pagination);

            // call api
            const { data, pagination } = await fetchCategoryProducts(page, this.search, this.category.id);

            this.products = setPaginate([
                ...this.products.data,
                ...data
            ], pagination);

            // ProductBoxesList callback, product list load completed
            done();
        },
        // event click icon on ProductBox
        onClickFavoriteIcon: async function (product) {
            if(!product.is_favorite) {
                const { data } = await favoriteService.createFavorite(product.id);

                // update product in list
                this.setItemInProductsList(data);
            } else {
                const { data } = await favoriteService.removeFavorite(product.id);

                // update product in list
                this.setItemInProductsList(data);
            }
        },
    },
    setup: async function () {
        const route = useRoute();

        const id = route.params.id; // category id
        const search = route.query.search ?? null;
        const page = nextPage();

        // fetch data
        const { data: category } = await categoryService.getCategoryById(id);
        const { data, pagination } = await fetchCategoryProducts(page, search, id);

        // master data
        return {
            category,
            search,
            dfProducts: setPaginate(data, pagination),
        }
    },
    created: async function () {
        this.products = this.dfProducts;
    },
}
