// components
import { TitleBar } from "@/components";
import CategorySwiper from "./components/CategorySwiper/CategorySwiper.vue";
import GiftBoxSwiper from "./components/GiftBoxSwiper/GiftBoxSwiper.vue";
import TrendingProductsList from "./components/TrendingProductsList/TrendingProductsList.vue";
import NotificationBar from "./components/NotificationBar/NotificationBar.vue";

// store
import { compositionService, favoriteService, productService } from "@/services";
import { nextPage, setPaginate } from "@/utils/paginator";

// load master data
const fetchCompositionData = async function () {
    const { data } = await compositionService.getHomeViewData();

    return {
        giftBoxes: data.gift_boxes,
        categories: data.categories,
    }
};

// load products list with pagination
const fetchTrendingProducts = async function (page) {
    // call api
    const response = await productService.getProducts({
        page,
    });

    return response;
};

export default {
    name: "HomeView",
    components: {
        TitleBar,
        NotificationBar,
        GiftBoxSwiper,
        CategorySwiper,
        TrendingProductsList,
    },
    data: function () {
        return {
            products: {},
        }
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
            const { data, pagination } = await fetchTrendingProducts(page);

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
        const page = nextPage(); // page 1

        // fetching data
        const { giftBoxes, categories } = await fetchCompositionData();
        const { data, pagination } = await fetchTrendingProducts(page);

        // master data & loading list
        return {
            giftBoxes,
            categories,
            dfProducts: setPaginate(data, pagination),
        }
    },
    created: function () {
        this.products = setPaginate(this.dfProducts.data, this.dfProducts.pagination);
    }
};
