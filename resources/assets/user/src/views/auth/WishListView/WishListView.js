import { favoriteService } from "@/services";
import { NAVBAR_STYLE_2 } from "@/utils/constants";
import { nextPage } from "@/utils/helper";

// components
import { ProductBoxesList } from "@/components";
import { setPaginate } from "@/utils/paginator";

// load user's favorite products
const fetchFavoriteProducts = async (page) => {
    const response = await favoriteService.getProducts({
        page,
    });

    return response;
}

export default {
    name: "WishListView",
    components: {
        ProductBoxesList,
    },
    data() {
        return {
            navbarStyle: NAVBAR_STYLE_2,
            products: {},
        };
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
        // event on click load more data
        onClickLoadMoreBtn: async function (done) {
            const page = nextPage(this.products.pagination);

            // call api
            const { data, pagination } = await fetchFavoriteProducts(page);

            this.products = setPaginate([
                ...this.products.data,
                ...data
            ], pagination);

            // ProductBoxesList callback, product list load completed
            done();
        },
    },
    setup: async function () {
        const page = nextPage(); // page 1

        // call api
        const {data, pagination } = await fetchFavoriteProducts(page);

        return {
            dfProducts: setPaginate(data, pagination),
        }
    },
    created: async function () {
        this.products = this.dfProducts;
    },
};
